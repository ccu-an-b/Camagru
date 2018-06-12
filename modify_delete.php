<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);

$page0="";
$page1 ="";
$page2 ="";
$page3 ="";
$page4 = get_page();

if (isset($_POST['submit']) && empty($_POST['pass']))
{
    $_SESSION['field'] = "1";
    $_SESSION['error'] = "* Champs obligatoires";
}

else if (isset($_POST['submit']) && isset($_POST['pass']))
{
    if (ft_user_check($_SESSION['login'], $_POST['pass']))
    {
        ft_del_user($_SESSION['login'], $profile['id']);
        ft_del_mail($profile['login'], $profile['mail']);
        header("Location: logout.php");
    }
}

$error = ft_error();

$field= ft_error_f();

require('view/m_deleteView.php');

?>