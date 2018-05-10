
<?php

$q = intval($_GET['q']);

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

$db = db_connect();
$sql = "SELECT * FROM user WHERE id ='".$q."'";
$req = $db->query($sql);
$row = $req->fetch();

print_r($row);
?>
