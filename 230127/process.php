<?php
if (isset($_POST['submit'])) {
    if ($_POST['username'] == "saad" && $_POST['password'] == "saad") {
        session_start();
        $_SESSION['logged_in'] = true;
        header('Location: sucess.php');
        exit;
    } else {
        echo "Identifiant ou mot de passe incorrect";
        header ("Refresh: 3;URL=index.php");
        exit;
    }
}
