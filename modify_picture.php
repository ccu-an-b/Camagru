<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);

$picture = get_picture($_SESSION['login']);

$page0="";
$page1 = "";
$page2 ="";
$page3 = get_page();
$page4 = "";

$error = ft_error();

if (isset($_POST['submit']) && isset($_POST['img']))
{
    foreach($_POST['img'] as $key)
    {
       ft_del_img($key);
    }
    header("Location: modify_picture.php");
}

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