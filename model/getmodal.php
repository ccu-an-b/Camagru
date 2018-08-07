<?php 

session_start();

include ("CamagruModel.php");
include ("../config/database.php");

function get_count_like($id_img)
{
	$db = db_connect();
	$sql= "SELECT COUNT(*) FROM likes WHERE id_img = '".$id_img."'";
	$req = $db->query($sql);
	$req = $req->fetch();
	$req = $req[0];
	return $req;
}

function get_modal_img($id)
{
	$db = db_connect();
	$sql = "SELECT date, img, login, profile, id_img FROM picture JOIN user WHERE picture.id_img ='".$id."' AND user.id = picture.id_user";
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

$res[1] = get_count_like($_GET['img']);

$array = get_modal_com($_GET['img']);  
$i = 0;
$data = array();
while ($req = $array->fetch())
{
  	$data[$i] = array('login' => $req['login'], 'text' => $req['text'], 'id_user' => $req['id_user'] );
 	$i++;
}  
$res[2] = $data;

if (isset($_SESSION['login']))
{$user = get_profile($_SESSION['login']);

if (!check_like($user['id'], $_GET['img']))
	$res[3] = "0";
else
	$res[3] = "1";
}
echo json_encode($res);
?>
