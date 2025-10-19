<?php
$host = "localhost";
$name = "mouhamed";
$password = "wampserver!";
$bd_name = "FACEBOOK";
$connect = mysqli_connect($host, $name, $password, $bd_name);
if (!$connect){
    die("Connexion erreur : ". mysqli_connect_error());
}
?>