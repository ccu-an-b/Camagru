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

function get_picture($id)
{
  $db = db_connect();
  $sql = "SELECT * FROM picture WHERE id_img ='".$id."'";
  $req = $db->query($sql);
  $db = NULL;
  return $req;
}

  $array = get_picture($_GET['q']);
  $array = $array->fetch();
  $source = $array['img'];
  
 echo "<img id='imgModal' src='".$source."' />";

?>