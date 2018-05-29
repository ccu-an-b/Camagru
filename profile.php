<?php

session_start();

require ('model/profileModel.php');

$profile = get_profile($_SESSION['login']);

$picture = get_picture($_SESSION['login']);

$count_picture = count_picture($_SESSION['login']);

$count_like = get_count($_SESSION['login'], 'like');

$count_comment = get_count($_SESSION['login'], 'comment');


if(isset($_POST['comment']) && $_POST['submit'] === 'valider')
{
    add_comment($_SESSION['login'], $_POST['comment'], $_POST['id']);
    header("Location: profile.php");
    
}

require('view/profileView.php');

?>

