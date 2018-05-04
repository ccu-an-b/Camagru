<?php

include ('config/database.php');

function db_connect()
{
	global $DB_DSN, $DB_USER, $DB_PASSWORD;
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	return $db;
}

function get_gallery()
{
	$db = db_connect();
	$sql = "SELECT * FROM picture";
	$req = $db->query($sql);

	return $req;
}

?>