<?php
define('DB_HOST', "mysql:host=localhost;dbname=Cour4"); 
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

	try {
        $conn = new PDO(DB_HOST, DB_USERNAME, DB_PASSWORD);
	} catch (Exception $e) {
        die("Erreur: " . $e->getMessage());
    }


