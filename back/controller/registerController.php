<?php
if(!$included){
    echo 'ntm';
} else {
    $action = $_POST['action'];
    $data = array();
    switch ($action) {
        case 'doRegister':
            //datas
            $mail = $_POST['mail'];
            $nom = $_POST['nom'];
            $pnom= $_POST['pnom'];
            $login= $_POST['login'];
            $mdp = hash('sha256',$_POST['mdp']);
            //VERIFIE SI LOGIN EXISTE PAS DEJA
            $stmt= $liaison->prepare('SELECT idUtilisateur FROM utilisateur WHERE uLogin = ?');
            $stmt->execute([$login]);
            if ($stmt->rowCount() == 0){
                //Pas existant donc on crée
                $data['statut'] = '200';
            } else {
                //Retourne log / mail existant
                $data['statut'] = '400';
            }
    }
}