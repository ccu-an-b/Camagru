<?php

include ('config/database.php');

function db_connect()
{
	global $DB_DSN, $DB_USER, $DB_PASSWORD;

	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	catch (PDOException $e) {
		echo 'Erreur de connection: ' . $e->getMessage();
	}
}

function get_page()
{
	$page = intval($_GET['page']); 
	if ($page <= 0) 
    	$page = 1;

    return $page;
}

function get_gallery($page, $limit)
{
	$db = db_connect();

	$start = ($page - 1) * $limit;
	$sql = 'SELECT * FROM picture ORDER BY UNIX_TIMESTAMP(date) DESC LIMIT :limite OFFSET :debut';
	$sql = $db->prepare($sql);
	$sql->bindValue('debut', $start, PDO::PARAM_INT);
	$sql->bindValue('limite', $limit, PDO::PARAM_INT);
	$sql->execute();

	return $sql;
}

function get_page_number($limit)
{
	$db = db_connect();
	$sql = 'SELECT * FROM picture ';
	$sql = $db->prepare($sql);
	$sql->execute();

	$row = $sql->rowCount();
	$count = ceil($row / $limit);
	return $count;

}

?>