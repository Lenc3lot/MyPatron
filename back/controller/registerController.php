<?php
if(!$included){
    echo 'ntm';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case 'doRegister':
            //datas
            $mail = strtolower($_POST['mail']);
            $nom = strtolower($_POST['nom']);
            $pnom= strtolower($_POST['pnom']);
            $login= strtolower($_POST['login']);
            $mdp = hash('sha256',$_POST['mdp']);
            //VERIFIE SI LOGIN EXISTE PAS DEJA
            $stmt= $liaison->prepare('SELECT idUtilisateur FROM utilisateur WHERE uLogin = ?');
            $stmt->execute([$login]);
            if ($stmt->rowCount() == 0){
                //Pas existant donc on crée
                $stmt = $liaison->prepare('INSERT INTO utilisateur VALUES (NULL,?,?,?,?,?);');
                $stmt->execute([$nom,$pnom,$login,$mdp,$mail]);
                $data['statut'] = '200';
            } else {
                //Retourne log / mail existant
                $data['statut'] = '400';
            }
            echo json_encode($data);
    }
}