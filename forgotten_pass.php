<?php

session_start();

require('model/CamagruModel.php');
include ("config/database.php");

$error = ft_error();

if (isset($_GET['key']) && isset($_GET['log']))
{
	$profile = get_profile($_GET['log']);
	if (empty($_GET['key']) || empty($_GET['log']) || ($profile['activation_key'] != $_GET['key']))
	{
		$_SESSION['error'] = "Lien non valide";
		header("Location: forgotten_pass.php");
	}
}

require('view/forgotten_passView.php');


?>