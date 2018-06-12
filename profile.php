<?php

session_start();

require ('model/profileModel.php');

$profile = get_profile($_SESSION['login']);

$picture = get_picture($_SESSION['login']);

$count_picture = count_picture($_SESSION['login']);

$count_like = get_count_user($profile['id'], 'likes');

$count_cmnt = get_count_user($profile['id'], 'comments');


if(isset($_POST['comment']) && $_POST['submit'] === 'valider')
{
    add_comment($_SESSION['login'], $_POST['comment'], $_POST['id']);
    header("Location: profile.php");  
}

else if (isset($_GET['like']))
{
    add_like($_SESSION['login'], $_GET['id']);
    header("Location: profile.php"); 
}


require('view/profileView.php');

?>

