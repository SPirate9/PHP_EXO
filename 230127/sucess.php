<?php
session_start();
include 'menu.php';
if(isset($_SESSION['logged_in'])) {
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h3>Bienvenue Saad</h3>
</body>
</html>
<?php
  }
  else{
    echo "<br>";
    echo "Veuillez vous connecter pour accéder à votre compte redirection automatique au bout de 5 secondes";
    header ("Refresh: 5;URL=index.php");
  }
  