<?php 

session_start();

include ("CamagruModel.php");
include ("../config/database.php");
include ("accountModel.php");

$profile = get_profile($_SESSION['login']);

if (isset($_GET['like']) && isset($_GET['com']))
{
    $com = '0';
    $like = '0';

    if ($_GET['like'] == 'true')
        $like = '1';
    if ($_GET['com'] == 'true')
        $com = '1';
    ft_mod_notif($_SESSION['login'], $profile, 'cmt', $com);
    ft_mod_notif($_SESSION['login'], $profile, 'like',$like); 
    $data[0] = 'notification';
    $data[1] = array('like' => $_GET['like'], 'comment' => $_GET['com']);
    if (empty($_SESSION['error']))
    {
        $_SESSION['error'] = "Aucun changement n&#39;a &eacute;t&eacute; effectu&eacute;";      
    }
    header('Location: modify_profile.php?page=3');
}

if (isset($_GET['old_pass']) && isset($_GET['new_pass']) && isset($_GET['new_pass_2']))
{

    if (empty($_GET['old_pass']) || empty($_GET['new_pass']) || empty($_GET['new_pass_2']))
    {
        $_SESSION['field'] = "1";
        $_SESSION['error'] = "* Champs obligatoires";
    }
    if (ft_user_check($_SESSION['login'], $_GET['old_pass']))
    {
        if ($_GET['new_pass'] == $_GET['new_pass_2'])
        {
            ft_mod_pass($_SESSION['login'], $_GET['new_pass']);
            $_SESSION['error'] = "Mot de passe modifi&eacute;";
        }
        else
        {
            $_SESSION['error'] = "Confirmation de mot de passe non identique";
        }
    }
    header('Location: modify_profile.php?page=2');
    $data[0] = 'password';

}



echo json_encode($data);