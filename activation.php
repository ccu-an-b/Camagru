<?php

session_start();

require("model/CamagruModel.php");
include ("config/database.php");

$profile = get_profile($_GET['log']);

if ($profile == "" || $profile['activation_key']!= $_GET['key'])
{
    $_SESSION['error'] = "Lien d&#39;activation non valide";
}

else if ($profile['active'] == 1)
{
    $_SESSION['error'] = "Votre compte a d&eacute;j&agrave; &eacute;t&eacute; activ&eacute;";
}

else {
    $_SESSION['error'] = "Votre compte vient d&ecirc;tre activ&eacute;";
    ft_activate_account($_GET['log']);
}


$error = ft_error();

require('view/activationView.php');

?>