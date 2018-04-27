<?PHP

include ("../config/database.php");

function ft_new_user($login, $pass, $mail, $conn)
{
	//	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	echo $DB_USER;
	//$conn = new PDO('mysql:host=localhost; dbname=db_camagru', 'root', '123456');
	$sql = "INSERT INTO `user` (`login`, `mail`, `pass`, `admin`) VALUES ('".$login."', '".$mail."', '".$pass."', '0')";
	if (!$conn->query($sql))
	{
		echo 'Error:'. $conn->error;
	}

}

?>
