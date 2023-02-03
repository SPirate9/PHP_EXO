<?php
include 'database.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (empty($username) || empty($password)) {
        echo "Veuillez renseigner tous les champs";
        header ("Refresh: 3;URL=index.php");
        exit();
    }
    else{
       $ret = $conn -> prepare ("SELECT * FROM tbl_user WHERE username = ? AND password = ? ");
       $ret -> execute([$username,$password]);
      if($ret -> rowCount() > 0){
        session_start();
        $_SESSION["userEmail"] = $username;
        header("Location: welcome.php");
        exit();
      }
      else{
        echo "Mot de passe ou identifiant Incorrect";
        header ("Refresh: 3;URL=index.php");
        exit();
      }
        
    }
    }


    