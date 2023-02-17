<?php

define('DB_HOST', "mysql:host=localhost;dbname=simpledb");
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

function db() {
    global $pdo;

    if (!isset($pdo)) {
        $pdo = new PDO(DB_HOST, DB_USERNAME, DB_PASSWORD);
    }
    
    return $pdo;
}
