<?php
require("database.php");

$db = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);

$sql = file_get_contents('db_camagru.sql');

$qr = $db->exec($sql);

header("Location:../index.php");
?>
