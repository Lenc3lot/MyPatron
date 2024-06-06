<?php
if(!$included){
    echo 'ACCES REFUSE';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case 'doLogin':
            $login =  strtolower($_POST['login']);
            $mdp = hash('sha256',$_POST['pwd']);
            $stmt = $liaison->prepare('SELECT idUtilisateur, uNom, uPNom FROM utilisateur WHERE uLogin=? AND uMdp =?');
            $stmt->execute([$login,$mdp]);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data['idUtilisateur'] = $row['idUtilisateur'];
                $data['uNom'] = $row['uNom'];
                $data['uPNom'] = $row['uPNom'];
            }
            if ($stmt->rowCount() != 0){
                $data['statut'] = '200';
            } else {
                $data['statut'] = '400';
            }
            echo json_encode($data);
            break;

        default:
            break;
    }
}