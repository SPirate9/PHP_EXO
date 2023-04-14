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
        <label>Nouveau Tweet : </label>
        <input type="text" name="content" />
        <button type="submit" name="post">Tweeter</button>
        <?php if (isset($_POST["post"])) {
            if (empty($_POST["content"])) {
                 echo "<p style='color:red'>Le tweet ne peut pas être vide</p>";
            } else {
                $insert = $conn->prepare(
                    "INSERT INTO posts ( content , userName ) VALUES (?,?)"
                );
                if ($insert->execute([$_POST["content"],$_SESSION["userName"]])) {
		 echo "<p style='color:green'>Le tweet a été publié avec succès</p>";
                }
            }
        } ?>
    </form>
    <p> Tweets : <?php
    $display = $conn->prepare("SELECT * FROM posts ORDER BY ID DESC LIMIT 10");
    $display->execute();
    $data = $display->fetchAll();
    foreach ($data as $post) {
	$postContent = $post["content"];
        $postDate = $post["created_at"];
        $postAuthor = $post["userName"];
        $postId = $post['ID'];
	    
	     if ($postAuthor === $_SESSION["userName"]) {
            echo "<div>{$postContent}: {$postDate} Posté par {$postAuthor}
                <form method='post'>
                    <input type='hidden' name='postId' value='{$postId}' />
                    <button type='submit' name='delete'>Supprimer</button>
                </form>
            </div>";
        } else {
            echo "<div>{$postContent}: {$postDate} Posté par {$postAuthor}</div>";
        }
    }
    if (isset($_POST["delete"])) {
        $delete = $conn->prepare("DELETE FROM posts WHERE ID = ? AND userName = ?");
        $delete->execute([$_POST["postId"], $_SESSION["userName"]]);
        header("Refresh: 0; URL= welcome.php");
        exit();
    }
    ?>
  </p>
</br>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
<?php } else {echo "Veuillez vous connecter pour accéder à votre compte redirection automatique au bout de 5 secondes";
    header("Refresh: 5;URL=index.php");}

