<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$picture = get_picture($_SESSION['login']);

$page3 = get_page();

require('view/m_pictureView.php');

?>