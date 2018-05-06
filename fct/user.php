<?PHP

include ('config/database.php');

function db_connect()
{
	global $DB_DSN, $DB_USER, $DB_PASSWORD;
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	return $db;
}

function ft_hash($login, $passwd)
{
	return hash('sha256', $login).hash('whirlpool', $passwd);
}

 function ft_user_check($login, $passwd)
 {
 	$passwd = ft_hash($login, $passwd);
 	$db = db_connect();
 	$sql = "SELECT * FROM user WHERE login='".$login."' AND pass='".$passwd."'";
	$req = $db->query($sql);
	$data = $req->fetch();
	if ($data == "")
		return false;
	else	
		return true;
 }

function ft_login_exist($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM user WHERE login='".$login."'";
	$data = $db->query($sql);
	$data = $data->fetch();
	if ($data == "")
		return false;
	else
		return true;
}

function ft_mail_exist($mail)
{
	$db = db_connect();
	$sql = "SELECT * FROM user WHERE mail='".$mail."'";
	$data = $db->query($sql);
	$data = $data->fetch();
	if ($data == "")
		return false;
	else
		return true;
}

function ft_user_new($login, $passwd, $mail)
{
	$db = db_connect();
	$passwd = ft_hash($login, $passwd); 
	if (ft_login_exist($login) || ft_mail_exist($mail))
		return false;
	$sql = "INSERT INTO `user` (`login`, `mail`, `pass`, `admin`) VALUES ('".$login."', '".$mail."', '".$passwd."', '0')";
	if (!$db->query($sql))
	{
		echo 'Error:'. $db->error();
		return false;
	}
	return true;
}


function ft_user_del($login)
{
	$db = db_connect();
	$sql = "DELETE FROM user WHERE user.login='".$login."'";
	$db->query($sql);
}

?>
