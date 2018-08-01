<?php 

session_start();

include ("CamagruModel.php");
include ("../config/database.php");
include ("accountModel.php");

$profile = get_profile($_SESSION['login']);

if ($_GET['page'] == '1')
{
    $error = '0';

    if (empty($_GET['mail']) || empty($_GET['login']))
    {
     	$_SESSION['field'] = "1";
    	$_SESSION['error'] = "* Champs obligatoires";
    }

    else 
    {   
        if (isset($_GET['bio']))
        {
            ft_mod_profile($profile['login'], $_GET['bio'], 'bio');
        }
     	if ($_GET['login'] != $profile['login'])
     	{
            if (!ft_login_exist($_GET['login']))
                $error = '1';
            else 
            {
                ft_mod_profile($profile['login'], $_GET['login'], 'login');
     	    	$_SESSION['error'] = "Nom d'utilisateur modifié.";
                $_SESSION['login'] = $_GET['login'];
                $profile = get_profile($_SESSION['login']);
            } 
     	}
     	if ($_GET['mail'] != $profile['mail'] && $error == '0')
     	{
            if (ft_mail_exist($_GET['mail']))
            {
                ft_mod_profile($profile['login'], $_GET['mail'], 'mail');
     		    if (isset($_SESSION['error']))
     			    $_SESSION['error'] = "Nom d'utilisateur et adresse mail modifiés.";
     		    else
                     $_SESSION['error'] = "Adresse mail modifiée.";
            }
     	}
    }
    $data = 1;
}

if ($_GET['page'] == '2')
{
    if (empty($_GET['old_pass']) || empty($_GET['new_pass']) || empty($_GET['new_pass_2']))
    {
        $_SESSION['field'] = "1";
        $_SESSION['error'] = "* Champs obligatoires";
    }

    else if (ft_user_check($_SESSION['login'], $_GET['old_pass']))
    {
        if ($_GET['new_pass'] != $_GET['new_pass_2'])
            $_SESSION['error'] = "Les mots de passe ne sont pas identiques";
        else if (password_secure($_GET['new_pass']))
            ft_mod_pass($_SESSION['login'], $_GET['new_pass']);
    }
    $data = 2;
}

if ($_GET['page'] == '3')
{
    $com = '0';
    $like = '0';

    if ($_GET['like'] == 'true')
        $like = '1';
    if ($_GET['com'] == 'true')
        $com = '1';

    ft_mod_notif($_SESSION['login'], $profile, 'cmt', $com);
    ft_mod_notif($_SESSION['login'], $profile, 'like',$like); 

    if (empty($_SESSION['error']))
    {
        $_SESSION['error'] = "Aucun changement n&#39;a &eacute;t&eacute; effectu&eacute;";      
    }
    $data = 3;
}

if ($_GET['page'] == '4')
{
    if (isset($_GET['picture']))
    {
        $img = explode('-', $_GET['picture']);
        foreach($img as $key)
        {
           ft_del_img($key);
        }
    }
    $data = 4;
}

if ($_GET['page'] == '5')
{
    $data = 5;
    if (empty($_GET['pass']))
    {
        $_SESSION['field'] = "1";
        $_SESSION['error'] = "* Champs obligatoires";
    }

    else
    {
        if (ft_user_check($_SESSION['login'], $_GET['pass']))
        {
            ft_del_user($_SESSION['login'], $profile['id']);
            ft_del_mail($profile['login'], $profile['mail']);
            $data = 'logout';
        }
    }
}

echo json_encode($data);