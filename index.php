<?PHP

include ("config/database.php");
include ("fct/user.php");

//echo $_SERVER['DOCUMENT_ROOT'];

if (isset($_POST['login']))
{
	echo "OK".PHP_EOL;
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	ft_new_user($_POST['login'], $_POST['passwd'], $_POST['mail'], $conn);
	//	header('Location: index.php');
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
