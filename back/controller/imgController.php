<?php
if(!$included){
    echo 'ntm';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case'deleteTempPict':
            $fileName = $_POST['fileName'];
            $idUser = $_POST['user'];
            unlink('../uploads/users/'.$idUser."/".$fileName);
            echo (json_encode('Done'));
            break;
        
        case'addTempPicture':
            $target_dir = "../uploads/temp/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
            echo(json_encode('done'));
    }
}