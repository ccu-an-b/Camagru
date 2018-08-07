<?php
require("database.php");

$db = new PDO("mysql:host=127.0.0.1", $DB_USER, $DB_PASSWORD);

$sql = file_get_contents('db_camagru.sql');

$qr = $db->exec($sql);

header("Location:../index.php");
?>
