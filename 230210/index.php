<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <form action="login.php" method="POST">
        <p>Connexion</p>
        <label>E-mail : </label>
        <input type="email" name="username" />
        <label>Mot de passe : </label>
        <input type="password" name="password" />
        <button type="submit" name="login">Connectez-vous</button>
    </form><br>
    <p>Vous n'avez pas encore de compte ? <a href="register.php">Inscrivez-vous</a></p>
    <p>Essayer <a href="welcome.php">&#128540;</a></p>
</body>

</html>