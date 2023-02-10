<?php
session_start();

if(isset($_SESSION['userEmail'])) {

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h3>Bienvenue <?= $_SESSION["userName"] ?></h3>
    <p>Votre E-mail est : <?=$_SESSION['userEmail'];?></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
  
<?php
  }
  else{
    echo "Veuillez vous connecter pour accéder à votre compte redirection automatique au bout de 5 secondes";
    header ("Refresh: 5;URL=index.php");
  }
  ?>
