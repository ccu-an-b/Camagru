<?php

include ('config/database.php');

function db_connect()
{
	global $DB_DSN, $DB_USER, $DB_PASSWORD;

	try 
	{
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	catch (PDOException $e) {
		echo 'Erreur de connection: ' . $e->getMessage();
	}
}

function get_profile($login)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE login = :login");
    $sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();

	return $sql; 
}

function get_count($id, $item, $table)
{
	$db = db_connect();
	$sql= "SELECT COUNT(*) FROM ".$table." WHERE ".$item." = '".$id."'";
	$req = $db->query($sql);
	$req = $req->fetch();

	return ($req[0]);
}

function ft_hash($login, $passwd)
{
	return hash('sha256', $login).hash('whirlpool', $passwd);
}

function ft_error()
{
	if(isset($_SESSION['error']))
	{
		$tmp = $_SESSION['error'];
		$_SESSION['error'] = NULL;
		return $tmp;
	}
	else
		return "";
}

?>