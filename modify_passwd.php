<?php

session_start();

require ('model/accountModel.php');

$profile = get_profile($_SESSION['login']);
$profile = $profile->fetch();

$page0="";
$page1 = get_page();
$page2 ="";
$page3 ="";
$page4 = "";


if (isset($_POST['submit']) && (empty($_POST['old_pass']) || empty($_POST['new_pass']) || empty($_POST['new_pass_2'])))
{
    $_SESSION['field'] = "1";
    $_SESSION['error'] = "* Champs obligatoires";
}

else if (isset($_POST['submit']))
{
    if (ft_pswd_check($_SESSION['login'], $_POST['old_pass']))
    {
        if ($_POST['new_pass'] == $_POST['new_pass_2'])
        {
            $_SESSION['error'] = "Mot de passe modifi&eacute;";
        }
        else
        {
            $_SESSION['error'] = "Confirmation de mot de passe non identique";
        }
    }
}

$error = ft_error();

$field= ft_error_f();


require('view/m_passwdView.php');

?>