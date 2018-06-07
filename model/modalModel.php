<?php 

$DB_DSN = 'mysql:host=localhost; dbname=db_camagru';
$DB_USER = 'root';
$DB_PASSWORD = '123456';

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

function get_count($id_img)
{
	$db = db_connect();
	$sql= "SELECT COUNT(*) FROM likes WHERE id_img = '".$id_img."'";
	$req = $db->query($sql);
	$req = $req->fetch();
	return $req;
}

function get_modal_img($id)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture JOIN user WHERE picture.id_img ='".$id."' AND user.id = picture.id_user";
	$req = $db->query($sql);
	$db = NULL;
	return $req;
}

function get_modal_com($id)
{
	$db = db_connect();
	$sql = "SELECT * FROM comments JOIN user WHERE comments.id_img ='".$id."' AND user.id =comments.id_user  ORDER BY comments.date DESC";
	$req = $db->query($sql);
	$db = NULL;
	return $req;
}

$data = get_modal_img($_GET['img']);
$res[0] = $data->fetch();

$res[1] = get_count($_GET['img']);

$array = get_modal_com($_GET['img']);  
$i = 0;
$data = array();
while ($req = $array->fetch())
{
  	$data[$i] = array('login' => $req['login'], 'text' => $req['text'], 'id_user' => $req['id_user'] );
 	$i++;
}  
$res[2] = $data;

echo json_encode($res);
?>
