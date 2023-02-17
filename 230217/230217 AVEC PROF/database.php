<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'simpledb');

function db() {
	global $conn;

	if ($conn !== NULL) {
		return $conn;
	}

	$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if($conn->connect_error){
		die(mysqli_error($conn));
	}
	return $conn;
}

