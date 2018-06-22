<?php

session_start();

require("model/CamagruModel.php");
include ("config/database.php");

if(empty($_SESSION['login']) && empty($_GET['user']))
    header('Location: index.php');

if (isset($_SESSION['login']))
    $login = $_SESSION['login'];

if (isset($_GET['user']))
    $login = $_GET['user'];
 
$profile = get_profile($login);

require('view/profileView.php');

?>

