<?PHP

include ("config/database.php");
include ("fct/user.php");

//echo $_SERVER['DOCUMENT_ROOT'];

if (isset($_POST['login']))
{
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	if (!ft_user_new($_POST['login'], $_POST['passwd'], $_POST['mail'], $conn))
		echo "Exist".PHP_EOL;
	//	header('Location: index.php');
	if (ft_user_check($_POST['login'], $_POST['passwd'], $conn) == true)
	 {
	 	echo "Pass OK".PHP_EOL;
	 }
	 else
	 	echo "Pass not OK".PHP_EOL;

	 ft_user_del('', $conn);
}



?>

<form action=""  method="post">
	<table>
		<tr>
			<td>Identifiant</td>
			<td><input type="text" name="login">
		</tr>
		<tr>
			<td>Mot de passe</td>
			<td><input type="password" name="passwd">
		</tr>
		<tr>
			<td>Mail</td>
			<td><input type="text" name="mail">
		</tr>
		<tr>
			<td></td>
			<td><input  type="submit" name="submit" value="S'inscrire"></td>
		</tr>
	</table>
</form>

