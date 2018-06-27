<?php

session_start();

include ("model/CamagruModel.php");
include ("config/database.php");
require ('model/accountModel.php');

if(empty($_SESSION['login']))
    header('Location: index.php');

$profile = get_profile($_SESSION['login']);
$picture = get_picture($_SESSION['login']);

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