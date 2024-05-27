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
            // $rqt = "INSERT INTO patron VALUES(NULL,".$pattern['patterName'].",".$pattern['patternDesc'].")";
        
        default:
            break;
    }
    echo json_encode($data);
}