<?php
include "connect.php";
if (isset($_POST['inscrire'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $date = $_POST['date'];
    $sexe = $_POST['sexe'];
    // Verification si le compte existe deja
    $sql = "SELECT ID FROM facebook WHERE EMAIL = ? ";
$stmt1 = mysqli_prepare($connect, $sql);
if ($stmt1) : 
mysqli_stmt_bind_param($stmt1, "s", $email);
mysqli_stmt_execute($stmt1);
$resultat = mysqli_stmt_get_result($stmt1);
if ($row = mysqli_fetch_array($resultat)){
        $message = "<p style='color:red;'>Desolez , ce compte a deja ete cree</p>";
}
     else {
        // hashage du mot de passe pour plus de securité
$password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // insertion dans la base de donnee
    $requete = "INSERT INTO facebook(NOM , PRENOM, EMAIL, MOT_DE_PASSE, DATE_NAISSANCE, SEXE) VALUES (?, ?, ?, ?, ?, ? )";
    $stmt = mysqli_prepare($connect, $requete);
    if ($stmt):
    mysqli_stmt_bind_param($stmt, "ssssss", $nom, $prenom, $email, $password, $date, $sexe);
    if (mysqli_stmt_execute($stmt)){
        $message = "<p style='color:green;'>Votre inscription est un succès</p>";
    } else{
        $message = "<p style='color:red;'>Votre Inscription a une erreur. Veuillez ressayer</p>";
    }

endif;
mysqli_stmt_close($stmt);

}
endif;
mysqli_stmt_close($stmt1);
mysqli_close($connect);
   
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACEBOOK</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
    }
    ._97vy {
        background-color: #fff;
        width: 400px;
        margin: 100px auto;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    ._97vu {
        width: 100px;
        margin-bottom: 20px;
    }
    ._97vw {
        text-align: center;
    }
    ._97vx {
        color: #1877f2;
        margin-bottom: 20px;
    }
    ._97vz {
        width: 90%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    ._97v- {
        background-color: #1877f2;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }
    ._97v0 {
        color: #1877f2;
        text-decoration: none;
        display: block;
        margin-top: 10px;
    }
</style>
<body>
    
<center>
<div class="_97vy"><img class="_97vu img" src="https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg" alt="Facebook">
    <div class="_97vw"> 
        <h2 class="_97vx">Inscrivez-vous sur Facebook</h2>
        <form action="" method="POST">
            <input type="text" name="nom" class="_97vz" placeholder="Nom" required><br>
            <input type="text" name="prenom" class="_97vz" placeholder="Prénom" required><br>
            <input type="email" name="email" class="_97vz" placeholder="Adresse e-mail" required><br>
            <input type="password" name="password" class="_97vz" placeholder="Nouveau mot de passe" required><br>
            <input type="date" name="date" class="_97vz" placeholder="Date de naissance" required><br>
            <select name="sexe" class="_97vz" required>
                <option value="" disabled selected>Sexe</option>
                <option value="femme">Femme</option>
                <option value="homme">Homme</option>
                <option value="autre">Autre</option>
            </select><br>
            <button type="submit" class="_97v-" name="inscrire">Inscription</button>
        </form>
        <a href="facebook_connexion.php" class="_97v0">Vous avez déjà un compte ? Connectez-vous</a>
        <?php if (isset($message)){
    echo $message;
}?>
    </div>
</div>

</center>

</body> 
</html>