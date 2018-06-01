<?php

include ('CamagruModel.php');


function get_page()
{
	if (empty($_GET['page']))
	{
		$_GET['page'] = 1;
	}
	$page = intval($_GET['page']); 
	if ($page <= 0) 
    	$page = 1;

    return $page;
}

function get_gallery($page, $limit)
{
	$db = db_connect();

	$start = ($page - 1) * $limit;
	$sql = 'SELECT * FROM picture ORDER BY UNIX_TIMESTAMP(date) DESC LIMIT :limite OFFSET :debut';
	$sql = $db->prepare($sql);
	$sql->bindValue('debut', $start, PDO::PARAM_INT);
	$sql->bindValue('limite', $limit, PDO::PARAM_INT);
	$sql->execute();

	return $sql;
}

function get_page_number($limit)
{
	$db = db_connect();
	$sql = 'SELECT * FROM picture ';
	$sql = $db->prepare($sql);
	$sql->execute();

	$row = $sql->rowCount();
	$count = ceil($row / $limit);
	return $count;

}

function add_comment($login, $comment, $id)
{
	$db = db_connect();
	$user = get_profile($login);
	$data = $user->fetch();
	$user_id = $data['id'];
	$sql = $db->prepare("INSERT INTO comments (id_user, id_img, text) VALUES ('".$user_id."', '".$id."', :text)");
	$sql->bindParam("text", $comment, PDO::PARAM_STR);
	$sql->execute();
	$sql = "UPDATE picture SET comment= comment + 1 WHERE id_img = '".$id."'";
	$db->query($sql);
}

function page_style($i, $page)
{
	if ($i == $page)
		echo " style='color: #EF626C; font-weight:bold; transform: scale(1.3)' ";
}

?>