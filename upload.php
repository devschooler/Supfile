<?php
session_start();
include_once('dbconf.php');
$user = $_SESSION['username'] ; 


$userDirectory = 'uploads'.$user;
if (!is_dir($userDirectory)) {
mkdir($userDirectory,0777);
}

if (!empty($_FILES)) {
 $tmpFile = $_FILES['file']['tmp_name'];
 $filename = $userDirectory.'/'.time().'-'. $_FILES['file']['name'];
 move_uploaded_file($tmpFile,$filename);
}


?>