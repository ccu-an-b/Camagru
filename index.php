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

require ('view/indexView.php');

