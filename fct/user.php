<?PHP

include ("../config/database.php");

function ft_hash($login, $pass)
{
	return hash('sha256', $login).hash('whirlpool', $pass);
}

 function ft_user_check($login, $pass, $conn)
 {
 	$pass = ft_hash($login, $pass);
 	$sql = "SELECT * FROM user WHERE login='".$login."' AND pass='".$pass."'";
	$req = $conn->query($sql);
	$data = $req->fetch();
	if ($data == "")
		return false;
	else	
		return true;
 }

function ft_login_exist($login, $conn)
{
	$sql = "SELECT * FROM user WHERE login='".$login."'";
	$data = $conn->query($sql);
	$data = $data->fetch();
	if ($data == "")
		return false;
	else
		return true;
}

function ft_mail_exist($mail, $conn)
{
	$sql = "SELECT * FROM user WHERE mail='".$mail."'";
	$data = $conn->query($sql);
	$data = $data->fetch();
	if ($data == "")
		return false;
	else
		return true;
}

function ft_user_new($login, $pass, $mail, $conn)
{
	$pass = ft_hash($login, $pass); 
	if (ft_login_exist($login, $conn) || ft_mail_exist($mail, $conn))
		return false;
	$sql = "INSERT INTO `user` (`login`, `mail`, `pass`, `admin`) VALUES ('".$login."', '".$mail."', '".$pass."', '0')";
	if (!$conn->query($sql))
	{
		echo 'Error:'. $conn->error();
		return false;
	}
	return true;
}


function ft_user_del($login, $conn)
{
	$sql = "DELETE FROM user WHERE user.login='".$login."'";
	$conn->query($sql);
}

?>
