<?PHP

include ('config/database.php');

session_start();

function db_connect()
{
	global $DB_DSN, $DB_USER, $DB_PASSWORD;

	try 
	{
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	catch (PDOException $e) {
		echo 'Erreur de connection: ' . $e->getMessage();
	}
}

function ft_hash($login, $passwd)
{
	return hash('sha256', $login).hash('whirlpool', $passwd);
}

 function ft_user_check($login, $passwd)
 {
 	$passwd = ft_hash($login, $passwd);
 	$db = db_connect();
 	try 
 	{
 		$sql = $db->prepare ("SELECT * FROM user WHERE login=:login AND pass=:passwd");
 		$sql->bindParam("login", $login, PDO::PARAM_STR);
 		$sql->bindParam("passwd", $passwd, PDO::PARAM_STR);
		$sql->execute();
		$data = $sql->fetch();
		if ($data == "")
		{
			$_SESSION['error'] = "Mauvais mot de passe ou identifiant";
			return false;
		}
		else if ($data['active'] === '0')
		{
			$_SESSION['error'] = "Votre compte n&#39;est pas encore activ&eacute;";
			return false; 
		}
		else	
		{
			$_SESSION['login'] = $login;
			return true;
		}
 	}
 	catch (PDOException $e) {
 		$db->rollback();
 		$_SESSION['error'] = "Mauvais mot de passe ou identifiant";
 	}
 }


function ft_login_exist($login)
{
	$db = db_connect();
	/*try 
	{*/
		$sql = $db->prepare("SELECT * FROM user WHERE login=:login");
		$sql->bindParam("login", $login, PDO::PARAM_STR);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		if ($data == "")
			return true;
		else
		{
			$_SESSION['error'] = "Ce nom d'utilisateur existe déja";
			return false;
		}
	// }
	// catch (PDOException $e) {
	// 	$db->rollback();
	// 	$db = NULL;
	// 	header('Location: ./subscription.php');
	// }
}

function ft_mail_exist($mail)
{
	$db = db_connect();
	try 
	{
		$sql = $db->prepare("SELECT * FROM user WHERE mail=:mail");
		$sql->bindParam("mail", $mail, PDO::PARAM_STR);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		if ($data == "")
			return true;
		else
		{
			$_SESSION['error'] = "Cette adresse mail est déjà utilisée";
			return false;
		}
	}
	catch (PDOException $e) {
		$_SESSION['error'] = "Adresse mail non valide";
		$db->rollback();
		$db = NULL;
		return false;
	}
}

function ft_user_new($login, $pass, $mail)
{
	$pass = ft_hash($login, $pass); 
	$db = db_connect();
	$activation_key = md5(microtime(TRUE)*100000);
	$sql = "INSERT INTO user (login, mail, pass, admin, activation_key) VALUES ('".$login."', '".$mail."', '".$pass."', '0', '".$activation_key."')";
	$db->query($sql);
	ft_activation_mail($login, $mail, $activation_key);
}


function ft_user_del($login)
{
	$db = db_connect();
	$sql = "DELETE FROM user WHERE user.login='".$login."'";
	$db->query($sql);
}

function ft_activation_mail($login, $mail, $key)
{
	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/html; charset=ISO-8859-1'."\n"."From: Camagru@contact.com"."\n";
	$subjet = "Camagru : activez votre compte"."\n";
	$message = "Bienvenue sur Camagru,"."\n\n";
	$message .="Pour activer votre compte, veuillez cliquer sur le lien ci dessous."."\n\n";
	$message .="http://127.0.0.1:8080/Camagru_git_o/subscription.php?log='.urlencode(".$login.").'&cle='.urlencode(".$key.")";
	$message .="\n\n\n"."---------------"."\n";
	$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";
	if ( mail($mail, $subjet, $message, $header)) 
	{
		echo 'Votre message a bien été envoyé ';
	}
	else 
	{
		echo "Votre message n'a pas pu être envoyé";
	}
}

// function ft_login_exist($login)
// {
// 	$db = db_connect();
// 	try 
// 	{
// 		$sql = $db->prepare("SELECT * FROM user WHERE login=:login");
// 		$sql->bindParam("login", $login, PDO::PARAM_STR);
// 		$sql->execute();
// 		$data = $sql->fetch();
// 		if ($data == "")
// 			return false;
// 		else
// 		{
// 			//$_SESSION['error'] = "Ce nom d'utilisateur existe déja";
// 			return true;
// 		}
// 	}
// // 	catch (PDOException $e) {
// //  		$db->rollback();
// //  		$_SESSION['error'] = "Nom d'utilisateur non valide";
// //  		header('Location: ./subscription.php');
// //  	}
//  }

// // function ft_mail_exist($mail)
// // {
// // 	$db = db_connect();
// // 	try {
// // 		$sql = $db->prepare ("SELECT * FROM user WHERE mail=:mail");
// // 		$sql->bindParam("mail", $mail, PDO::PARAM_STR);
// // 		$sql->execute();
// // 		$data = $sql->fetch(PDO::FETCH_OBJ);
// // 		if ($data == "")
// // 			return false;
// // 		else
// // 		{
// // 		//	$_SESSION['error'] = "Cette adresse mail est déja utilisée";
// // 			return true;
// // 		}
// // 	}
// // 	catch (PDOException $e) {
// //  		$db->rollback();
// //  		$_SESSION['error'] = "Adresse mail non valide";
// //  		header('Location: ./subscription.php');
// //  	}
// // }

// function ft_user_new($login, $passwd, $mail)
// {
// 	$db = db_connect();
// 	$passwd = ft_hash($login, $passwd); 
// 	$sql = "INSERT INTO `user` (`login`, `mail`, `pass`, `admin`) VALUES ('".$login."', '".$mail."', '".$passwd."', '0')";
// 	// if (!$db->query($sql))
// 	// {
// 	// 	echo 'Error:'. $db->error();
// 	// 	return false;
// 	// }
// 	 return true;
// }


// function ft_user_del($login)
// {
// 	$db = db_connect();
// 	$sql = "DELETE FROM user WHERE user.login='".$login."'";
// 	$db->query($sql);
// }


function ft_error()
{
	if($_SESSION['error'] != NULL)
	{
		$tmp = $_SESSION['error'];
		$_SESSION['error'] = NULL;
		return $tmp;
	}
	else
		return "";
}
?>
