<?php

include ('config/database.php');

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

function get_profile($login)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE login = :login");
    $sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();

	return $sql; 
}

function get_count($id, $item, $table)
{
	$db = db_connect();
	$sql= "SELECT COUNT(*) FROM ".$table." WHERE ".$item." = '".$id."'";
	$req = $db->query($sql);
	$req = $req->fetch();

	return ($req[0]);
}

function ft_hash($login, $passwd)
{
	return hash('sha256', $login).hash('whirlpool', $passwd);
}

function ft_user_check($login, $passwd)
{
	$passwd = ft_hash($login, $passwd);
	$db = db_connect();

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

function add_comment($login, $comment, $id)
{
	$db = db_connect();
	$user = get_profile($login);
	$data = $user->fetch();
	$user_id = $data['id'];
	$sql = $db->prepare("INSERT INTO comments (id_user, id_img, text) VALUES ('".$user_id."', '".$id."', :text)");
	$sql->bindParam("text", $comment, PDO::PARAM_STR);
	$sql->execute();
	ft_comment_mail($id, $login, $comment);
}

function ft_comment_mail($id_img, $user, $comment)
{
	$db = db_connect();
	$sql = "SELECT mail, notif_cmt FROM picture Join user WHERE picture.id_user = user.id AND picture.id_img = '".$id_img."'";
	$profile = $db->query($sql);
	$profile = $profile->fetch();

	if ($profile['notif_cmt'] == '1')
	{
		$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
		$subjet = "Camagru : Nouveau commentaire"."\n";

		$message = "Vous avez un nouveau commentaire de ".$user.":\n\n";
		$message .= '"'.$comment.'"';
		$message .="\n"."---------------"."\n";
		$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";

		mail($profile['mail'], $subjet, $message, $header);
	}
}

function add_like($login, $id)
{
	$db = db_connect();
	$user = get_profile($login);
	$data = $user->fetch();
	$user_id = $data['id'];
	$sql = "INSERT INTO likes (id_user, id_img) VALUES ('".$user_id."', '".$id."')";
	$req = $db->query($sql);
	ft_like_mail($id, $login);
}

function ft_like_mail($id_img, $user)
{
	$db = db_connect();
	$sql = "SELECT mail, notif_like FROM picture Join user WHERE picture.id_user = user.id AND picture.id_img = '".$id_img."'";
	$profile = $db->query($sql);
	$profile = $profile->fetch();

	if ($profile['notif_like'] == '1')
	{
		$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
		$subjet = "Camagru : Nouveau like"."\n";

		$message = "Vous avez un nouveau like de ".$user.":\n\n";
		$message .="\n"."---------------"."\n";
		$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";

		mail($profile['mail'], $subjet, $message, $header);
	}
}

function ft_error()
{
	if(isset($_SESSION['error']))
	{
		$tmp = $_SESSION['error'];
		$_SESSION['error'] = NULL;
		return $tmp;
	}
	else
		return "";
}

?>