<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$page0="";
$page1 ="";
$page2 ="";
$page3 ="";
$page4 = get_page();

$error = ft_error();

$field= ft_error_f();

require('view/m_deleteView.php');

?>