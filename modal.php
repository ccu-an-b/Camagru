<?php 

include ("model/CamagruModel.php");

function get_count_like($id_img)
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

echo json_encode($res);
?>
