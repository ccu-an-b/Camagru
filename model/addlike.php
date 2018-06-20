<?php 

session_start();

include ("CamagruModel.php");
include ("../config/database.php");
include ("profileModel.php");

function get_img($id)
{
	$db = db_connect();
	$sql = "SELECT * FROM picture WHERE id_img ='".$id."'";
    $req = $db->query($sql);
    $req = $req->fetch();
	$db = NULL; 
	return $req;
}

if (isset($_GET['img']))
{
    $id_img = $_GET['img'];
    add_like($_SESSION['login'], $id_img);
}

else if(isset($_GET['com']))
 {
    $id_img = $_GET['com'];
    add_comment($_SESSION['login'], $_GET['comment'], $id_img); 
 }

if (isset($_SESSION['login']))
    $profile = get_profile($_SESSION['login']);

$picture = get_img($id_img);

$count_com = get_count($id_img, 'id_img', 'comments');
$count_like = get_count($id_img, 'id_img', 'likes');

if (empty($_SESSION['login']) || !check_like($profile['id'], $id_img))
    $like_src = "public/icons/like.png";
else
    $like_src = "public/icons/like_2.png";

$data[0] = array('id_img' => $id_img, 'img' => $picture['img'], 'count_com' => $count_com, 'count_like' => $count_like, 'like_src' => $like_src);

$count_like = get_count_user($picture['id_user'], 'likes');
$count_com = get_count_user($picture['id_user'], 'comments');

$data[1] = array('like' => $count_like, 'comment' => $count_com);


echo json_encode($data);
?>