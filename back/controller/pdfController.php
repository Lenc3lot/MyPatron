<?php
if(!$included){
    echo 'ACCES REFUSE';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case'addTempPdf':
            $files = $_FILES;
            $nbFiles = $_POST['nbPDF'];
            $target_dir = "./uploads/temp/";
            for ($i=0; $i < $nbFiles; $i++) { 
                $target_file = $target_dir . basename($_FILES["fileToUpload".$i]["name"]);
                move_uploaded_file($_FILES["fileToUpload".$i]["tmp_name"],$target_file);
            }
            $data['statut'] = '200';
            echo json_encode($data);
            break;
        
        case'deletePDF':
            $idPDF = $_POST['idPDF'];
            $stmt = $liaison->prepare("DELETE FROM pdf WHERE idPDF = ?");
            $stmt->execute([$idPDF]);
            $data['statut'] = '200';
            break;
    }
}