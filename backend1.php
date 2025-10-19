<?php
session_start();

include "connect.php";
if (!isset($_SESSION['id'])){
    header("Location: facebook_connexion.php");
}
$id = $_SESSION['id'];
$sql = "SELECT * from facebook WHERE ID = ?";
$stmt = mysqli_prepare($connect, $sql);
if ($stmt){
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
}









?>
<h1>Bonjour Et Bienvenue <?= $_SESSION['prenom']. " ". $_SESSION['nom'] ;?> vous etes nee le <?= date("d/m/Y", strtotime($_SESSION['date'])) ;?> </h1>

<br><br><br>
<a href="backend2.php"><button name = "deconnecter">Deconnecter</button></a>