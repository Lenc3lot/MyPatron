<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: text/html; charset=utf-8');
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('Europe/Paris');

include('./functions.php');
$liaison = CallDatabase();
$included = false;

$routes = [
    'login' => './controller/loginController.php',
    'register' => './controller/registerController.php',
    'user' => './controller/userController.php',
    'app' => './controller/application.php',
    'classe' => './controller/classeController.php',
    'pattern' => './controller/patternController.php',
    'tags' => './controller/tagsController.php',
    'img' => './controller/imgController.php',
];

if (isset($_POST['id'])) $id = $_POST['id']; else $id = 0;

$myServerAddress = 'localhost';

$joker = true;
if (isset($_POST['req'])){
    $route = $routes[$_POST['req']];
} else { 
    $req=0;
    echo 'ERROR';
}

if($joker) {
    $included = true;
    include($route);
}
else echo "<h1>No credentials sent !</h1>";