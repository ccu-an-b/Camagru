<?php
session_start();

include ('model/indexModel.php');
include ("model/CamagruModel.php");
include ("config/database.php");

$page = get_page();

$limit = 9;

$gallery = get_gallery($page, $limit);

$page_count = get_page_number($limit);

if (isset($_SESSION['login']))
    $profile = get_profile($_SESSION['login']);

//$page_count = 200;

require ('view/indexView.php');

