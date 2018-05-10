<?php 

include ('config/database.php');

include('./model/profileModel.php');

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
