<?php

session_start();

require('model/userModel.php');

if ((empty($_POST['login']) || empty($_POST['passwd']) || empty($_POST['mail']) || empty($_POST['mail'])) && isset($_POST['submit']))
	$_SESSION['error'] = "Champs incomplets";
else if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['passwd2']) && isset($_POST['mail'])&& isset($_POST['submit']) )
{
	if (ft_login_exist($_POST['login']) && ft_mail_exist($_POST['mail']))
	{
		if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail']) == false)
			$_SESSION['error'] = "Adresse e-mail non valide";
		else if ($_POST['passwd'] != $_POST['passwd2'])
			$_SESSION['error'] = "Les mots de passe ne sont pas identiques";
		else
		 {
		 	ft_user_new($_POST['login'], $_POST['passwd'], $_POST['mail']);
		 	$_SESSION['error'] = "Un mail de confirmation vient d'&ecirc;tre envoy&eacute;";
		 }
	}
}

$error = ft_error();

require('view/subscriptionView.php');
?>