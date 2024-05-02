<?php

if(!$included){
    echo 'ntm';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case 'doTest':
            $rqt = 'SELECT * FROM marque';
            $stmt = $liaison->query($rqt);
            $rows = $stmt->fetchAll();
            $data = $rows;
            echo(json_encode($data));
            break;
        
        default:
            break;
            
    }
}