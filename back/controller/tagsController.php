<?php
if(!$included){
    echo 'ntm';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case 'getAllTags':
            $rqt = 'SELECT * FROM tag';
            $stmt = $liaison->query($rqt);
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
                $returntab = [];
                $returntab['idTag']= $row['idTag'];
                $returntab['tLibel']= $row['tLibel'];
                $data[] = $returntab;
            }
            break;

        default:
            break;
    }
    echo json_encode($data);
}