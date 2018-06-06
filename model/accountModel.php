<?PHP

include ('CamagruModel.php');

function get_page()
{
	return " style='font-weight:bold' ";
}

function get_picture($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture p INNER JOIN user u ON p.id_user = u.id WHERE u.login ='".$login."' ORDER BY UNIX_TIMESTAMP(date) DESC";
	$req = $db->query($sql);

	return $req;
}

function ft_mod_pass($login, $new_pass)
{
	$db = db_connect();
	$passwd = ft_hash($login, $new_pass);
	$sql = $db->prepare("UPDATE user SET pass=:new WHERE login=:login");
	$sql->bindParam(":new", $passwd, PDO::PARAM_STR);
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	return true;
}

function ft_mod_notif($login, $profile, $notif, $form)
{
	$notif = "notif_".$notif;

	if (($form == '1' && $profile[$notif] == '0')||($form == '0' && $profile[$notif] == '1'))
    {
		$db = db_connect();
		$sql = "UPDATE user SET ".$notif."='".$form."' WHERE login='".$login."'";
		$db->query($sql);
		if (empty($_SESSION['error']))
			$_SESSION['error'] = "Changement pris en compte";
		else
			$_SESSION['error'] = "Changements pris en compte";
	}
}

function ft_del($id, $table, $item)
{
	$db = db_connect();
	$sql = "DELETE  FROM ".$table."  WHERE ".$table.".".$item." = '".$id."'";
	$db->query($sql);
}

function ft_del_img($id_img)
{
	ft_del($id_img, 'comments', 'id_img');
	ft_del($id_img, 'likes', 'id_img');
	ft_del($id_img, 'picture', 'id_img');
}

function ft_del_user($login, $id)
{
	$picture = get_picture($login);
	while ($data = $picture->fetch())
	{
		ft_del_img($data['id_img']);
	}
	ft_del($id, "comments", "id_user");
	ft_del($id, "likes", "id_user");
	ft_del($id, "user", "id");
}

function ft_del_mail($login, $mail)
{
	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subjet = "Camagru : suppression de votre compte"."\n";

	$message = "Votre compte vient d'être supprimé."."\n\n";
	$message .="\n\n"."---------------"."\n";
	$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";
	mail($mail, $subjet, $message, $header);
}


function ft_error_f()
{
	if(isset($_SESSION['field']))
	{
		$_SESSION['field'] = NULL;
		return "*";
	}
	else
		return "";
}

?>