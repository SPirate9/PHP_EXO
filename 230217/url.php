<?php
include "database.php";

$res = mysqli_fetch_assoc(db()->query("SELECT * FROM urls WHERE slug = '{$_GET["slug"]}'"));
header("Location: {$res["url"]}");
exit();
