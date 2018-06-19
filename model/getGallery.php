<?php
session_start();

include ("CamagruModel.php");
include ("../config/database.php");
include ('indexModel.php');
include ('profileModel.php');

if (isset($_GET['user']))
{
    $data[0] = 'profile';
    $picture = get_picture($_GET['user']);
}

else {
    $data[0] = 'index';
    $page = $_GET['page'];
    $limit = 9;
    $picture = get_gallery($page, $limit);
}

if (isset($_SESSION['login']))
    $profile = get_profile($_SESSION['login']);

$i = 0;
while ($res = $picture->fetch())
{   
    $count_com = get_count($res['id_img'], 'id_img', 'comments');
    $count_like = get_count($res['id_img'], 'id_img', 'likes');
    if (empty($_SESSION['login']) || !check_like($profile['id'], $res['id_img']))
        $like_src = "public/icons/like.png";
    else
        $like_src = "public/icons/like_2.png";
    $data[1][$i] = array('id_img' => $res['id_img'], 'img' => $res['img'], 'count_com' => $count_com, 'count_like' => $count_like, 'like_src' => $like_src);
    $i++;
}

echo json_encode($data);

?>