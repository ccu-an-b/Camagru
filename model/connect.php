<?php

session_start();

include ("CamagruModel.php");
include ("../config/database.php");


if ($_GET['page'] == 'password')
{
    if (empty($_GET['mail']))
	    $_SESSION['error'] = "Champs incomplets";
    else    
    {
        if(!ft_mail_exist($_GET['mail']))
        {
            ft_retrieve_mail($_GET['mail']);
            $_SESSION['error'] = 'Un mail vient d&#39;&ecirc;tre envoy&eacute; &agrave <br/>'.$_GET['mail'];
        }
        else
            $_SESSION['error'] = 'Cette adresse mail n&#39;existe pas';
    }

    $page = "forgotten_pass.php";
}

if ($_GET['page'] == 'new_password')
{
    if (empty($_GET['new_pass']) || empty($_GET['new_pass_2']) || empty($_GET['login']))
    {
        $_SESSION['error'] = "Champs incomplets";
        $page = "reload";
    }
    else
    {
        if ($_GET['new_pass'] != $_GET['new_pass_2'])
        {
            $_SESSION['error'] = "Les mots de passe ne sont pas identiques";
            $page = "reload";
        }
        else
        {
            ft_mod_pass($_GET['login'], $_GET['new_pass']);
            $key = md5(microtime(TRUE)*100000);
            ft_mod_profile($_GET['login'], $key, 'activation_key');
            $_SESSION['error'] = "Mot de passe modifi&eacute;";
            $page = "connexion.php";
        }
    }
}

echo json_encode($page);

?>