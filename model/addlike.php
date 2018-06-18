<?php 

session_start();

include ("CamagruModel.php");
include ("../config/database.php");

if (isset($_GET['img']))
{
    add_like($_SESSION['login'], $_GET['img']);
}

else if(isset($_GET['com']))
 {
     add_comment($_SESSION['login'], $_GET['comment'], $_GET['com']); 
 }

echo json_encode("OK");
?>