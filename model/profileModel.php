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

function get_picture($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture p INNER JOIN user u ON p.id_user = u.id WHERE u.login ='".$login."' ORDER BY UNIX_TIMESTAMP(date) DESC";
	$req = $db->query($sql);

	return $req;
}

function get_profile($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM user WHERE login ='".$login."'";
	$req = $db->query($sql);

	return $req;
}

function count_picture($login)
{
	$req = get_picture($login);
	$count = 0;
	while ($req->fetch())
		$count++;
	return $count;
}

function get_count($login, $elem)
{
	$req = get_picture($login);
	$count = 0;
	while ($data = $req->fetch())
	{
		$count += $data[$elem];
	}
	return $count;
}

function add_comment($login, $comment, $id)
{
	$db = db_connect();
	$user = get_profile($login);
	$data = $user->fetch();
	$user_id = $data['id'];
	$sql = $db->prepare("INSERT INTO comments (id_user, id_img, text) VALUES ('".$user_id."', '".$id."', :text)");
	$sql->bindParam("text", $comment, PDO::PARAM_STR);
	$sql->execute();
	$sql = "UPDATE picture SET comment= comment + 1 WHERE id_img = '".$id."'";
	$db->query($sql);
}

?>
