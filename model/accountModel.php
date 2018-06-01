<?PHP

include ('CamagruModel.php');

function get_page()
{
	return " style='font-weight:bold' ";
}

function ft_mod($old, $new)
{
	$db = db_connect();
		$sql = $db->prepare("UPDATE user SET login=:new WHERE login=:old");
		$sql->bindParam(":new", $new, PDO::PARAM_STR);
		$sql->bindParam(":old", $old, PDO::PARAM_STR);
		$sql->execute();
		$db = NULL;
	return true;

}

function get_picture($login)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture p INNER JOIN user u ON p.id_user = u.id WHERE u.login ='".$login."'";
	$req = $db->query($sql);

	return $req;
}

?>