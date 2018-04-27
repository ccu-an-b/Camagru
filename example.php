<?php

include ("config/database.php");

//mysql_connect("", "", "");
//mysql_select_db(database_name);

$bdd = new PDO('mysql:host=localhost; dbname=db_ccu-an-b', 'root', '123456');

//$req1 = mysql_query

$req1 = $bdd->query('SELECT * FROM ft_table WHERE id = 6');

//$donnees = mysql_fetch_array(result)

$donnees = $req1->fetch();

echo $donnees['id'].':'.$donnees['login'].'<br />';

$req2 = $bdd->query('SELECT * FROM promotion');
//$donnees2 = $req2->fetch();

while($donnees2 = $req2->fetch())
{
	echo $donnees2['name'].'<br />';
}

$sql = "INSERT INTO `ft_table` (`login`, `group`, `creation_date`) VALUES ('loki', 'staff', '2013-05-01')";

$bdd->query($sql);

echo $DB_USER;
//PDO::quote escape sql
?>
