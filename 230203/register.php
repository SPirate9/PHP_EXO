<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>

<body>
    <p>Créer un compte</p>
    <form action="add.php" method="post">
        <label>Votre nom : </label>
        <input type="text" name="name" />
        <label>Votre E-mail : </label>
        <input type="email" name="username" />
        <label> Mot de passe : </label>
        <input type="password" name="password"/>
        <button type="submit" name="register">S'inscrire</button>
    </form>
    <p>J'ai déjà un compte <a href="index.php">Connexion</a>
    </p>
</body>

</html>

