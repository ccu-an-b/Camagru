<?php 

include ('config/database.php');

include('./model/profileModel.php');

if (isset($_GET['q'])){
  $array = get_modal($_GET['q']);
  $array = $array->fetch();

  echo json_encode($array);
}




?>
