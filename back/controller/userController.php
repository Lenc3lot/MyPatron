<?php

if(!$included){
    echo 'ACCES REFUSE';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case 'doTest':
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

        case 'getInfos':
            $idUser = $_POST['idUser'];
            $stmt = $liaison->prepare('SELECT uLogin, uNom, uPNom,uMail FROM utilisateur WHERE idUtilisateur=?');
            $stmt->execute([$idUser]);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data['uLogin'] = $row['uLogin'];
                $data['uNom'] = $row['uNom'];
                $data['uPNom'] = $row['uPNom'];
                $data['uMail'] = $row['uMail'];
            }
            if ($stmt->rowCount() != 0){
                $data['statut'] = '200';
            } else {
                $data['statut'] = '400';
            }
            break;
        
        
        case'updateInfos':
            $rqt = "UPDATE utilisateur SET ";
            $params = array();
            foreach ($_POST as $key => $value) {
                if ($key != 'req' && $key != 'action' && $key != 'idUser') {
                    $rqt .= "$key = ?, ";
                    $params[] = $value;
                }
            }
            $rqt = substr($rqt, 0, -2);
            $rqt .= " WHERE idUtilisateur = ?"; 
            $params[] = $_POST['idUser'];
            $stmt = $liaison->prepare($rqt);
            $stmt->execute($params);
            $data['statut'] = '200';
            break;  
            
        default:
            break;
            
    }
    echo json_encode($data);
}