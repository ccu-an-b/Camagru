<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

if ((empty($_POST['login']) || empty($_POST['mail'])) && isset($_POST['submit']))
{
 	$_SESSION['field'] = "1";
 	$_SESSION['error'] = "* Champs obligatoires";
}

// else 
// {
// 	if ($_POST['login'] != $profile['login'])
// 	{
// 		//ft_mod($profile['login'], $_POST['login']);
// 		$_SESSION['error'] = "Nom d'utilisateur modifié";
// 		$_SESSION['login'] = $_POST['login'];
// 		$profile = get_profile($_SESSION['login']);
// 		$profile = $profile->fetch();
// 	}
// 	if ($_POST['mail'] != $profile['mail'])
// 	{
// 		if ($_SESSION['error'] != NULL)
// 			$_SESSION['error'] = "Nom d'utilisateur et adresse mail modifiés";
// 		else
// 			$_SESSION['error'] = "Adresse mail modifiée";
// 	}
// }



$error = ft_error();

$field= ft_error_f();


require('view/a_profileView.php');

?>