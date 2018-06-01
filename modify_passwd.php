<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$page0="";
$page1 = get_page();
$page2 ="";
$page3 ="";
$page4 = "";

$error = ft_error();


require('view/m_passwdView.php');

?>