<?php

include ('CamagruModel.php');

function get_picture($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture p INNER JOIN user u ON p.id_user = u.id WHERE u.login ='".$login."' ORDER BY UNIX_TIMESTAMP(date) DESC";
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

function get_count_user($id_user, $table)
{
	$db = db_connect();
	$sql = "SELECT COUNT(*) FROM ".$table." JOIN picture ON ".$table.".id_img = picture.id_img WHERE picture.id_user = '".$id_user."'";
	$req = $db->query($sql);
	$req = $req->fetch();

	return ($req[0]);
}

function ft_activate_account($login)
{
	$db = db_connect();
	$sql = $db->prepare("UPDATE user SET active = '1' WHERE login = :login ");
	$sql->bindParam('login', $login, PDO::PARAM_STR);
	$sql->execute();
}

?>
