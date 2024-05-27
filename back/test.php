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

$target_dir = "uploads/users/user0/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// echo(basename($_FILES["fileToUpload"]["name"]));
// // $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// echo $imageFileType;
echo move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   print_r($check);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }
// echo hash('sha256','AdminR0Xmdp');
?>