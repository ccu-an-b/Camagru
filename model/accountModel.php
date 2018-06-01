<?PHP

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


function get_page()
{
	return " style='font-weight:bold' ";
}

function get_profile($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM user WHERE login ='".$login."'";
	$req = $db->query($sql);
	$db = NULL;
	return $req;
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

function ft_mod($old, $new)
{
	$db = db_connect();
	/*try 
	{*/
		$sql = $db->prepare("UPDATE user SET login=:new WHERE login=:old");
		$sql->bindParam(":new", $new, PDO::PARAM_STR);
		$sql->bindParam(":old", $old, PDO::PARAM_STR);
		$sql->execute();
		$db = NULL;
	return true;

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

function get_picture($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture p INNER JOIN user u ON p.id_user = u.id WHERE u.login ='".$login."'";
	$req = $db->query($sql);

	return $req;
}

?>