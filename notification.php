<?php

session_start();

include ("model/CamagruModel.php");

function get_notification($id_profile)
{
    $db = db_connect();
    $sql ="SELECT  c.id_user AS id_user, c.id_img AS id_img, text , c.date AS date, c.active AS active, profile, login, img FROM comments c, user u, picture p WHERE c.id_profile='".$id_profile."' AND u.id = c.id_user AND p.id_img = c.id_img UNION ALL SELECT l.id_user AS id_user, l.id_img AS id_img, NULL as text , l.date AS date, l.active AS active, profile AS profile, login, img FROM likes l, user u, picture p WHERE l.id_profile ='".$id_profile."' AND u.id = l.id_user AND p.id_img = l.id_img ORDER BY UNIX_TIMESTAMP(date) DESC";

    $res = $db->query($sql);
    $data = array();
    $i = 0;
    while ($req = $res->fetch())
    {
          $data[$i] = array('id_user' => $req['id_user'], 'id_img' => $req['id_img'], 'text' => $req['text'],'date' => $req['date'], 'active' => $req['active'], 'login' => $req['login'], 'profile' => $req['profile'],'img' => $req['img']);
         $i++;
    }  
    return ($data);
}

function count_notification($id_profile)
{
    $db = db_connect();
    $sql = "SELECT COUNT(*) FROM comments where id_profile = '".$id_profile."' AND active ='1' UNION ALL SELECT COUNT(*) FROM likes WHERE id_profile = '".$id_profile."' AND active ='1'";
    $res = $db->query($sql);
    $count = 0;
    while($data = $res->fetch())
    {
        $count += $data[0];
    }
    return ($count);
}

$res = NULL;
if (isset($_SESSION['login']))
{
    $profile = get_profile($_SESSION['login']);
    $data = get_notification($profile['id']);
    $res[0] = $data;
    $res[1] = count_notification($profile['id']);
}
echo json_encode($res);