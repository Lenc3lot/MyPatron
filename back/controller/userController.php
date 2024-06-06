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

        case 'doLogin':
            $login = $_POST['uLogin'];
            $mdp = hash('sha256',$_POST['uMdp']);
            $stmt = $liaison->prepare('SELECT idUtilisateur, uNom, uPNom FROM utilisateur WHERE uLogin=? AND uMdp =?');
            $stmt->execute([$login,$mdp]);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data['idUtilisateur'] = $row['idUtilisateur'];
                $data['uNom'] = $row['uNom'];
                $data['uPNom'] = $row['uPNom'];
            }
            if ($stmt->rowCount() != 0){
                $data['statut'] == '200';
            } else {
                $data['statut'] == '400';
            }
            break;
        
        default:
            break;
            
    }
    echo json_encode($data);
}