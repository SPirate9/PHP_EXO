<?php
include 'menu.php';
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulaire</title>
</head>
<body>
	<h1>Ceci est le formulaire de contact : </h1>
	<form method="POST" action ="process.php">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" id="username">
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password">
    <button type="submit" name="submit">Connectez-vous</button>
</form>
    
    <p>username = saad <br> password = saad</p>

<body>
</html>
