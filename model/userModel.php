<?PHP

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
		$_SESSION['error'] = "Ce nom d'utilisateur existe d&eacute;&agrave;.";
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
		$_SESSION['error'] = "Cette adresse mail existe d&eacute;&agrave;.";
		return false;
	}
}

function ft_user_new($login, $pass, $mail)
{
	$pass = ft_hash($login, $pass); 
	$db = db_connect();
	
	$login = htmlspecialchars($login);
	$pass = htmlspecialchars($pass);
	$mail = htmlspecialchars($mail);
	
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
	$message .="Pour activer votre compte veuillez cliquer sur le lien ci dessous."."\n\n";
	$message .= $link;
	$message .="\n\n"."---------------"."\n";
	$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";
	if ( !mail($mail, $subjet, $message, $header)) 
	{
		$_SESSION['error'] = "Une erreur s&#39;est produite lors de l&#39;envoi du mail de confirmation.<br/> Veuillez recommencer la proc&eacute;dure";
	}
}

function ft_mod_pass($login, $new_pass)
{
	$db = db_connect();
	$passwd = ft_hash($login, $new_pass);
	$sql = $db->prepare("UPDATE user SET pass=:new WHERE login=:login");
	$sql->bindParam(":new", $passwd, PDO::PARAM_STR);
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	$_SESSION['error'] = "Mot de passe modifi&eacute;";
	return true;
}

function ft_retrieve_mail($mail)
{
	$db = db_connect();
	$sql = $db->prepare( "SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam(":mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$profile = $sql->fetch();
	$db = null;

	$link = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$link = str_replace("model/connect.php", "", $link);
	$link .= "forgotten_pass.php?log=".urlencode($profile['login'])."&key=".urlencode($profile['activation_key']);

	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subjet = "Camagru : Récupération de mot de passe\n";

	$message = "Pour modifier votre mot de passe veuillez cliquer sur le lien ci dessous."."\n\n";
	$message .= $link;
	$message .="\n"."---------------"."\n";
	$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";

	mail($profile['mail'], $subjet, $message, $header);
}

function ft_mod_profile($login,$new_item,$item)
{
	$db = db_connect();

	$login = htmlspecialchars($login);
	$new_item = htmlspecialchars($new_item);

	$sql = $db->prepare("UPDATE user SET ".$item."=:new_item WHERE login=:login");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("new_item", $new_item, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	return true;
}

?>
