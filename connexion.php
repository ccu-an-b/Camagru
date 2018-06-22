<?php

session_start();

require('model/CamagruModel.php');
include ("config/database.php");

if ((empty($_POST['login']) || empty($_POST['passwd'])) && isset($_POST['submit']))
	$_SESSION['error'] = "Champs incomplets";
else if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) )
	if(ft_user_check($_POST['login'], $_POST['passwd']))
		header('Location: ./profile.php');

$error = ft_error();

require('view/connexionView.php');
?>