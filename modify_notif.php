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

require('view/m_notifView.php');

?>