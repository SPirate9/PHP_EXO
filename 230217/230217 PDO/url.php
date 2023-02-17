<?php
include "database.php";

$stmt = db()->prepare("SELECT * FROM urls WHERE slug = :slug");
$stmt->bindParam(":slug", $_GET["slug"]);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
header("Location: {$res["url"]}");
exit();
