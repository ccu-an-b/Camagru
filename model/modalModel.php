<?php 

include ('CamagruModel.php'); 

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

if (isset($_GET['img'])){
  $data = get_modal_img($_GET['img']);
  $data = $data->fetch();
  echo json_encode($data);
}

else if (isset($_GET['com'])){
  $array = get_modal_com($_GET['com']);
  
  $i = 0;
  $data = array();
  while ($res = $array->fetch())
  {
  	$data[$i] = array('login' => $res['login'], 'text' => $res['text'], 'id_user' => $res['id_user'] );
  	$i++;
  }
  echo json_encode($data);
}



?>
