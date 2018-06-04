<?PHP

include ('CamagruModel.php');

function get_page()
{
	return " style='font-weight:bold' ";
}

function get_picture($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture p INNER JOIN user u ON p.id_user = u.id WHERE u.login ='".$login."'";
	$req = $db->query($sql);

	return $req;
}

function ft_pswd_check($login, $pass)
{
	$passwd = ft_hash($login, $pass);
	$db = db_connect();

	$sql = $db->prepare ("SELECT * FROM user WHERE login=:login AND pass=:passwd");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
   	$sql->bindParam("passwd", $passwd, PDO::PARAM_STR);
   	$sql->execute();
  	$data = $sql->fetch();
  	if ($data == "")
    {
	   $_SESSION['error'] = "Mauvais mot de passe";
	   return false;
    }
    return true;
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