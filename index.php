<?php
session_start();

require_once ('model/indexModel.php');

$page = get_page();

$limit = 9;

$gallery = get_gallery($page, $limit);

$page_count = get_page_number($limit);

if (isset($_SESSION['login']))
    $profile = get_profile($_SESSION['login']);

//$page_count = 200;

if(isset($_POST['comment']) && isset($_POST['submit']))
{
    if (empty($_SESSION['login']))
    {
        ?><script>alert("Vous devez vous connectez"); </script><?php
    }
    else
    {
        add_comment($_SESSION['login'], $_POST['comment'], $_POST['id']);
        header("Location: index.php");
    }  
}

else if (isset($_GET['like']))
{
    if (empty($_SESSION['login']))
    {
        ?><script>alert("Vous devez vous connectez"); </script><?php
    }
    else
    {
        add_like($_SESSION['login'], $_GET['id']);
        header("Location: index.php");
    } 
}
 
require ('view/indexView.php');

