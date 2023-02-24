<?php
include 'database.php';

if (isset($_POST["register"])) {
    $name = $_POST["name"];
    $username= $_POST['username'];
    $password = $_POST["password"];
    if (empty($name) || empty($username) || empty($password)) {
        echo "Veuillez renseigner tous les champs";
        header ("Refresh: 3;URL=register.php");
        exit();  
}
else {
    $check = $conn -> prepare("SELECT * FROM users WHERE userEmail = ? ");
    $check -> execute([$username]);
    if($check -> rowCount()>0){ 
        echo"Cette adresse e-mail est déjà utilisée"; 
        header("Refresh: 3;URL=register.php");
        exit();
        }else{
            $hashedpassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );
            $insert = $conn -> prepare("INSERT INTO users ( userName , userEmail , userPassword ) VALUES (?, ?, ?)");
            if($insert -> execute([$name,$username,$hashedpassword])){
                echo"Votre compte a été créé avec succès ! "; ?> <!DOCTYPE html> <a href="index.php">Se connecter</a> </html>
    <?php
            }

        }
       
    }
}