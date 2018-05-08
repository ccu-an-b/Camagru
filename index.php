<?php

session_start();

require ('model/indexModel.php');

$page = get_page();

$limit = 9;

$gallery = get_gallery($page, $limit);

$page_count = get_page_number($limit);

//$page_count = 200;

require ('view/indexView.php');

