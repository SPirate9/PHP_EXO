<?php
include "database.php";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (empty($username) || empty($password)) {
        echo "Veuillez renseigner tous les champs";
        header("Refresh: 3;URL=index.php");
        exit();
    } else {
        $ret = $conn->prepare(
            "SELECT * FROM users WHERE userEmail = :username"
        );
        $ret->bindParam(":username", $username);
        if ($ret->execute()) {
            if ($username != $row["userEmail"]) {
                echo "Mot de passe ou identifiant Incorrect";
                header("Refresh: 3;URL=index.php");
            }
            if ($row = $ret->fetch()) {
                $passwordverify = password_verify(
                    $password,
                    $row["userPassword"]
                );
                if ($passwordverify == false) {
                }
                if ($passwordverify == true) {
                    session_start();
                    $_SESSION["userEmail"] = $row["userEmail"];
                    $_SESSION["userName"] = $row["userName"];
                    header("Location: welcome.php");
                    exit();
                }
            }
        }
    }
}
