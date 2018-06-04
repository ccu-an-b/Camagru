<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$page0="";
$page1 ="";
$page2 = get_page();
$page3 ="";
$page4 = "";

$error = ft_error();

if (isset($_POST['submit']))
{
    ft_mod_notif($_SESSION['login'], $profile, 'cmt', $_POST['notif_cmt']);
    ft_mod_notif($_SESSION['login'], $profile, 'like', $_POST['notif_like']);
    if (empty($_SESSION['error']))
    {
        $_SESSION['error'] = "Aucun changement n&#39;a &eacute;t&eacute; effectu&eacute;";
        header('Location: modify_notif.php');   
        
    }
    else
    {
        header('Location: modify_notif.php');    
    }
}


require('view/m_notifView.php');

?>