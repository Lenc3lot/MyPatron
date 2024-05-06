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
            $rqt = 'INSERT INTO p';
        
        default:
            break;
    }
    echo json_encode($data);
}