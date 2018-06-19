<?php

session_start();

require ('model/profileModel.php');
include ("model/CamagruModel.php");
include ("config/database.php");

if(empty($_SESSION['login']) && empty($_GET['user']))
    header('Location: index.php');

if (isset($_SESSION['login']))
{
    $login = $_SESSION['login'];
    $profile_session = get_profile($_SESSION['login']);
}
   
if (isset($_GET['user']))
{
    $login = $_GET['user'];
    $url = "?user=".$_GET['user'];
}
   
$profile = get_profile($login);

$picture = get_picture($login);

$count_picture = count_picture($login);

$count_like = get_count_user($profile['id'], 'likes');

$count_cmnt = get_count_user($profile['id'], 'comments');

require('view/profileView.php');

?>

