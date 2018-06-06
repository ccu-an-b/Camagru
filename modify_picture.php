<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$picture = get_picture($_SESSION['login']);

$page0="";
$page1 = "";
$page2 ="";
$page3 = get_page();
$page4 = "";

$error = ft_error();

$count = get_count($profile['id'],"id_user", "comments");
echo $count[0];

if (isset($_POST['submit']) && isset($_POST['img']))
{
    foreach($_POST['img'] as $key)
    {
       echo $key ;
       ft_del_img($key);
    }
}

require('view/m_pictureView.php');

?>