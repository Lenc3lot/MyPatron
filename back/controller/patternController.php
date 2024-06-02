<?php
if(!$included){
    echo 'ntm';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {

        case 'getPatternBrand':
            $rqt = 'SELECT * FROM marque';
            $stmt = $liaison->query($rqt);
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $returntab = [];
                $returntab['idMarque']= $row['idMarque'];
                $returntab['libelMarque']= $row['libelMarque'];
                $data[] = $returntab;
            }
            break;
        
        case 'getPatternType':
            $rqt = 'SELECT * FROM typepatron';
            $stmt = $liaison->query($rqt);
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $returntab = [];
                $returntab['idTypePatron']= $row['idTypePatron'];
                $returntab['tpLibel']= $row['tpLibel'];
                $data[] = $returntab;
            }
            break;

        case 'addNewPattern':
            // AJOUT DU PATTERN EN BASE
            $idUser = $_POST['idUser'];
            $pattern = json_decode($_POST['pattern'],true);

            //REQUETE
            $rqt = "INSERT INTO patron(idPatron,pLibel,pDesc,pCheminPhoto,pLien,idMarque,idTypePatron,idUtilisateur) VALUES(NULL";
            foreach ($pattern as $key => $value) {
                if($key != 'patternTag'){
                    $rqt.= ','.$value;
                }
            }
            $rqt .= ','.$idUser.');';

            //DEPLACEMENT DE L'IMAGE// 
            
            //REP TEMPORAIRE
            $tempDir = "./uploads/temp/";

            //CHECK SI DOSSIER LIE A L'UTILISATEUR EXISTE
            if(is_dir("./uploads/users/user".$idUser)){
                $defDir = "./uploads/users/user".$idUser."/".$pattern['patternPicture'];
                copy($tempDir.$pattern['patternPicture'],$defDir);
                unlink('./uploads/temp/'.$pattern['patternPicture']);
            }else{
                //CREE LE DOSSIER LIE A L'USER SI EXISTE PAS
                mkdir("./uploads/users/user".$idUser);
                $defDir = "./uploads/users/user".$idUser."/".$pattern['patternPicture'];
                copy($tempDir.$pattern['patternPicture'],$defDir);
                unlink('./uploads/temp/'.$pattern['patternPicture']);
            }

            // AJOUT PATRON DANS lA TABLE patron
            $stmt = $liaison->prepare('INSERT INTO patron VALUES (NULL,?,?,?,?,?,?,?)');
            $name = $pattern['patterName'];
            $desc = $pattern['patternDesc'];
            $brand = $pattern['patternBrand'];
            $type = $pattern['patternType'];
            $link = $pattern['patternLink'];
            $stmt->execute([$name,$desc,$defDir,$brand,$idUser,$type,$link]);


            $idPatronInsert = $liaison->lastInsertId();

            // DEPLACEMENT DU PDF 
            $nomsPDF = $pattern['patternPDF'];
            $nbPDF = count($nomsPDF);
            for ($i=0; $i < $nbPDF; $i++) {
                $defDir = "./uploads/users/user".$idUser."/".$nomsPDF[$i];
                copy($tempDir.$nomsPDF[$i],$defDir);
                unlink('./uploads/temp/'.$nomsPDF[$i]);
                //insertion du path du PDF dans la BDD
                $stmt = $liaison->prepare('INSERT INTO pdf VALUES (NULL,?,?)');
                $stmt->execute([$defDir,$idPatronInsert]);
            }

            
            //Ajout des tags en BDD
            $tags = $pattern['patternTag'];
            $nbTags = count($tags);
            for ($i=0; $i < $nbTags; $i++) { 
                $stmt = $liaison->prepare('INSERT INTO posséder VALUES(?,?)');
                $stmt->execute([$idPatronInsert,$tags[$i]]);
            }
            
            $data['statut'] = '200';
            break;

        case 'getAllPatern':
            //Premièrement on récupère TOUT les IDs des patrons de l'user
            $idUser = $_POST['idUser'];
            $stmt = $liaison->prepare('SELECT idPatron FROM patron WHERE idUtilisateur = ?');
            $stmt->execute([$idUser]);
            $rows = $stmt->fetchAll();
            $listeId = [];
            foreach ($rows as $row) {
                $listeId[]=$row['idPatron'];
            }
            // echo json_encode($listeId);

            //On va ensuite récup toutes les données propres à chaque patron et les mettres dans un tableau
            $allPattern = [];
            foreach ($listeId as $idPatron) {
                // Récup les infos générales
                $stmt = $liaison->prepare('SELECT pLibel,pDesc,pCheminPhoto,P.idMarque,libelMarque,P.idTypePatron,tpLibel,pLien
                FROM patron P
                INNER JOIN marque M
                ON M.idMarque = P.idMarque
                INNER JOIN typepatron TP
                ON TP.idTypePatron = P.idTypePatron
                WHERE idPatron = ?;');
                $stmt->execute([$idPatron]);
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $data[$idPatron] = $rows;
                $data[$idPatron]['idPatron'] = $idPatron;
                
                //Récup les infos PDF
                $stmt = $liaison->prepare('SELECT idPDF,relativePath
                FROM pdf
                WHERE idPatron = ?;');
                $stmt->execute([$idPatron]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $data[$idPatron]['infoPdf'] = $rows;

                //Récup les infos des tags
                $stmt = $liaison->prepare('SELECT T.idTag,tLibel
                FROM tag T
                INNER JOIN posséder P
                ON P.idTag = T.idTag
                WHERE P.idPatron = ?;');
                $stmt->execute([$idPatron]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $data[$idPatron]['tags'] = $rows;

                // echo json_encode($unPatron);
                // $data[] = $unPatron;
            }
            break;

        case 'deletePattern':
            //Fonction suppression de patron
            //1er temps suppression des enregistrements avec clé etrangères
            $idPatron = $_POST['idPatron'];

            //Suppresion
            $stmt = $liaison->prepare('DELETE FROM posséder WHERE idPatron =?;
            DELETE FROM pdf WHERE idPatron =?;
            DELETE FROM patron WHERE idPatron=?;');
            $stmt->execute([$idPatron,$idPatron,$idPatron]);

            //2eme temps, suppression serveurs des PDF
            $pdf = json_decode($_POST['pdfInfos'],true);
            echo (count($pdf));
            if(count($pdf) == 1){
                unlink($pdf[0]['relativePath']);
            }else{
                $i = 0;
                foreach ($pdf as $pdfInfos) {
                    $deletefile = $pdfInfos[$i]['relativePath'];
                    unlink($deletefile);
                    $i++;
                }
            }

            //3eme temps, suppression des images
            $img = $_POST['pCheminPhoto'];
            unlink($img);
            break;

        case 'selectSpeType':
            //Premièrement on récupère TOUT les IDs des patrons de l'user
            $idUser = $_POST['idUser'];
            $idTypePatron = $_POST['idTypePatron'];
            $idTag = $_POST['idTag'];
            $idMarque = $_POST['idMarque'];
            
            $params = [$idUser];

            $rqt = 'SELECT Pa.idPatron 
            FROM patron Pa
            INNER JOIN posséder P
            ON P.idPatron = Pa.idPatron
            WHERE idUtilisateur = ?';

            if($idTypePatron != ''){
                $rqt.= ' AND idTypePatron = ?';
                $params[] = $idTypePatron;
            }
            
            if ($idTag != ''){
                $rqt.= ' AND idTag = ?';
                $params[] = $idTag;
            }   

            if ($idMarque != ''){
                $rqt .= ' AND idMarque = ?';
                $params[] = $idMarque;
            }
            $stmt = $liaison->prepare($rqt);
            
            // echo $rqt;
            
            $stmt->execute($params);
            $rows = $stmt->fetchAll();
            $listeId = [];
            foreach ($rows as $row) {
                $listeId[]=$row['idPatron'];
            }

            //On va ensuite récup toutes les données propres à chaque patron et les mettres dans un tableau
            $allPattern = [];
            foreach ($listeId as $idPatron) {
                // Récup les infos générales
                $stmt = $liaison->prepare('SELECT pLibel,pDesc,pCheminPhoto,P.idMarque,libelMarque,P.idTypePatron,tpLibel,pLien
                FROM patron P
                INNER JOIN marque M
                ON M.idMarque = P.idMarque
                INNER JOIN typepatron TP
                ON TP.idTypePatron = P.idTypePatron
                WHERE idPatron = ?;');
                $stmt->execute([$idPatron]);
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $data[$idPatron] = $rows;
                $data[$idPatron]['idPatron'] = $idPatron;
                
                //Récup les infos PDF
                $stmt = $liaison->prepare('SELECT idPDF,relativePath
                FROM pdf
                WHERE idPatron = ?;');
                $stmt->execute([$idPatron]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $data[$idPatron]['infoPdf'] = $rows;

                //Récup les infos des tags
                $stmt = $liaison->prepare('SELECT T.idTag,tLibel
                FROM tag T
                INNER JOIN posséder P
                ON P.idTag = T.idTag
                WHERE P.idPatron = ?;');
                $stmt->execute([$idPatron]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $data[$idPatron]['tags'] = $rows;

                // echo json_encode($unPatron);
                // $data[] = $unPatron;
            }
            break;
        
        default:
            break;
    }
    echo json_encode($data);
}