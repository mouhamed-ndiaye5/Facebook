 <?php
 session_start();

 include "connect.php";
 if (isset ($_POST['connecter'])){
$email = $_POST['email'];
$password = $_POST['password'];
// passage a la requete sql
$requete = "SELECT * FROM facebook WHERE EMAIL = ? ";
$securite = mysqli_prepare($connect, $requete);
if ($securite):
mysqli_stmt_bind_param($securite, "s", $email);
mysqli_stmt_execute($securite);
$result = mysqli_stmt_get_result($securite);

if ($row = mysqli_fetch_array($result)) {
    if (password_verify($password, $row['MOT_DE_PASSE'])){
      $_SESSION['id'] = $row['ID'];
       $_SESSION['nom'] = $row['NOM'];
        $_SESSION['prenom'] = $row['PRENOM'];
         $_SESSION['email'] = $row['EMAIL'];
          $_SESSION['date'] = $row['DATE_NAISSANCE'];
        header("Location: backend1.php"); exit() ;
    } else{
        $message = "<p style='color:red;'>Mot de passe incorrecte</p>";
    }
} else {
    $message = "<p style='color:red;'>Identifiant incorrecte</p>";
}
endif;
mysqli_stmt_close($securite);
mysqli_close($connect);
 }
 
 
 
 
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facebook_login</title>
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
        ._97v1 {
            margin: 20px 0;
        }
        ._97v2 {
            background-color: #42b72a;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <br><br><br>
<center>
<div class="_97vy"><img class="_97vu img" src="https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg" alt="Facebook">
    <div class="_97vw">
        <h2 class="_97vx">Connectez-vous à Facebook</h2>
        <form method="post" action="">
            <input type="text" name="email" placeholder="Adresse e-mail ou numéro de téléphone" class="_97vz" required><br>
            <input type="password" name="password" placeholder="Mot de passe" class="_97vz" required><br>
            <button type="submit" class="_97v-" name = "connecter">Connexion</button>
        </form>
      <a href="#" class="_97v0">Mot de passe oublié 
        <hr class="_97v1">
        <a href="facebook_inscrire.php"><button class="_97v2">Créer un compte Facebook</button></a>
      
    </div>
   <?php if (isset($message)){
    echo $message;
}?>
</div>
</center>



    </body>
</html>