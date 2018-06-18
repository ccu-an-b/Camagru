<?php

session_start();

require ('model/profileModel.php');

$login = $_SESSION['login'];

if (isset($_GET['user']))
{
    $login = $_GET['user'];
    $url = "?user=".$_GET['user'];
    echo $url;
}
    
$profile = get_profile($login);
$profile_session = get_profile($_SESSION['login']);

$picture = get_picture($login);

$count_picture = count_picture($login);

$count_like = get_count_user($profile['id'], 'likes');

$count_cmnt = get_count_user($profile['id'], 'comments');


require('view/profileView.php');

?>

