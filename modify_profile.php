<?php

session_start();

include ("model/CamagruModel.php");
include ("config/database.php");
require ('model/accountModel.php');

if(empty($_SESSION['login']))
    header('Location: index.php');

$profile = get_profile($_SESSION['login']);
$picture = get_picture($_SESSION['login']);

//if ((empty($_POST['login']) || empty($_POST['mail'])) && isset($_POST['submit']))
//{
// 	$_SESSION['field'] = "1";
//	$_SESSION['error'] = "* Champs obligatoires";
//}

// else 
// {
// 	if ($_POST['login'] != $profile['login'])
// 	{
// 		//ft_mod($profile['login'], $_POST['login']);
// 		$_SESSION['error'] = "Nom d'utilisateur modifié";
// 		$_SESSION['login'] = $_POST['login'];
// 		$profile = get_profile($_SESSION['login']);
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

if ( empty($_GET['page']) )
    $_GET['page'] = '1';

switch ($_GET['page']) {
    case 1:
        require('view/m_profileView.php');
        break;
    case 2:
        require('view/m_passwdView.php');
        break;
    case 3:
        require('view/m_notifView.php');
        break;
    case 4:
        require('view/m_pictureView.php');
        break;
    case 5:
        require('view/m_deleteView.php');
        break;
}
?>