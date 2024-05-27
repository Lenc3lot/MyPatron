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
            $rqt = "INSERT INTO patron(idPatron,pLibel,pDesc,pCheminPhoto,pLien,idMarque,idTypePatron,idUtilisateur) VALUES(NULL";
            foreach ($pattern as $key => $value) {
                if($key != 'patternTag'){
                    $rqt.= ','.$value;
                }
            }
            echo($rqt);
            $rqt .= ','.$idUser.');';
            //DEPLACEMENT DE L'IMAGE 
            // copy('./uploads/temp/'.$pattern['patternPicture'],'./uploads/users/user'.$idUser);
            $tempDir = "./uploads/temp/";
            $defDir = "./uploads/users/user".$idUser."/".$pattern['patternPicture'];
            copy($tempDir.$pattern['patternPicture'],$defDir);
            unlink('./uploads/temp/'.$pattern['patternPicture']);
            // $rqt = "INSERT INTO patron VALUES(NULL,".$pattern['patterName'].",".$pattern['patternDesc'].")";
        
        default:
            break;
    }
    echo json_encode($data);
}