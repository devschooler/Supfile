<?php

$servername = 'localhost';
$username = 'root';
$password = 'kingofcod';
$dbname = 'supcloud';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    echo ' problème de base de donnée !! '.mysqli_connect_error();
}