<?php
session_start();

include ("model/CamagruModel.php");
include ("config/database.php");
include ("model/indexModel.php");

if (!db_connect())
{
?>
	<br/>
	<p>Pour configurer la base de donn&eacute;es <a href="config/setup.php">cliquez ici</a><p>
<?php
}

else
{
	$page = get_page();

	$limit = 9;

	$gallery = get_gallery($page, $limit);

	$page_count = get_page_number($limit);

	if (isset($_SESSION['login']))
    $profile = get_profile($_SESSION['login']);

	//$page_count = 200;

	require ('view/indexView.php');
}

