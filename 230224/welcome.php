<?php
session_start();
include "database.php";
if (isset($_SESSION["userEmail"])) { ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h3>Bienvenue <?= $_SESSION["userName"] ?></h3>
    <p>Votre E-mail est : <?= $_SESSION["userEmail"] ?></p>
    <form method="post">
        <label>Nouveau Tweet :  </label>
        <input type="text" name="content" />
        <button type="submit" name="post">Tweeter</button>
        <?php if (isset($_POST["post"])) {
            if (empty($_POST["content"])) {
                echo " ";
                header("Refresh: 0; URL= welcome.php");
                exit();
            } else {
                $insert = $conn->prepare(
                    "INSERT INTO posts ( content ) VALUES (?)"
                );
                if ($insert->execute([$_POST["content"]])) {
                }
            }
        } ?>
    </form>
    <p>Vos Tweet : <?php
    $display = $conn->prepare("SELECT * FROM posts ORDER BY ID DESC LIMIT 10");
    $display->execute();
    $data = $display->fetchAll();
    foreach ($data as $post) {
        echo "
        <div>
            {$post["content"]} :  
            {$post["created_at"]}
        </div>
      
		";
    }
    ?>
  </p>
</br>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
<?php } else {echo "Veuillez vous connecter pour accéder à votre compte redirection automatique au bout de 5 secondes";
    header("Refresh: 5;URL=index.php");}
?>
