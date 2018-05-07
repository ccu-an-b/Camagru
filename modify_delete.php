<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$page4 = get_page();

require('view/m_deleteView.php');

?>