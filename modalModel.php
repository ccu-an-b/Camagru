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

function get_modal_img($id)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture WHERE id_img ='".$id."'";
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
