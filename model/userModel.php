<?PHP

include ('CamagruModel.php');

function ft_login_exist($login)
{
	$db = db_connect();
	
	$sql = $db->prepare("SELECT * FROM user WHERE login=:login");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return true;
	else
	{
		$_SESSION['error'] = "Ce nom d'utilisateur existe déja";
		return false;
	}
}

function ft_mail_exist($mail)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return true;
	else
	{
		$_SESSION['error'] = "Cette adresse mail est déjà utilisée";
		return false;
	}
}

function ft_user_new($login, $pass, $mail)
{
	$pass = ft_hash($login, $pass); 
	$db = db_connect();
	$activation_key = md5(microtime(TRUE)*100000);
	$sql = $db->prepare("INSERT INTO user (login, mail, pass, admin, activation_key) VALUES (:login, :mail, :pass, '0', '".$activation_key."')");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->bindParam("pass", $pass, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	ft_activation_mail($login, $mail, $activation_key);
}


function ft_user_del($login)
{
	$db = db_connect();
	$sql = "DELETE FROM user WHERE user.login='".$login."'";
	$db->query($sql);
	$db = null;
}

function ft_activation_mail($login, $mail, $key)
{
	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subjet = "Camagru : activez votre compte"."\n";
	$link = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$link = str_replace("subscription.php", "", $link);
	$link .='activation.php?log='.urlencode($login).'&key='.urlencode($key);

	$message = "Bienvenue sur Camagru,"."\n\n";
	$message .="Pour activer votre compte, veuillez cliquer sur le lien ci dessous."."\n\n";
	$message .= $link;
	$message .="\n\n"."---------------"."\n";
	$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";
	if ( !mail($mail, $subjet, $message, $header)) 
	{
		$_SESSION['error'] = "Une erreur s&#39;est produite lors de l&#39;envoi du mail de confirmation.<br/> Veuillez recommencer la proc&eacute;dure";
	}
}

?>
