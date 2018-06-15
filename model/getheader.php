<?php

session_start();
include ("../config/database.php");
include ("CamagruModel.php");

function get_notification($id_profile)
{
    $db = db_connect();
    $sql ="SELECT  c.id_user AS id_user, c.id_img AS id_img, text , c.date AS date, c.active AS active, profile, login, img FROM comments c, user u, picture p WHERE c.id_profile='".$id_profile."' AND u.id = c.id_user AND p.id_img = c.id_img UNION ALL SELECT l.id_user AS id_user, l.id_img AS id_img, NULL as text , l.date AS date, l.active AS active, profile AS profile, login, img FROM likes l, user u, picture p WHERE l.id_profile ='".$id_profile."' AND u.id = l.id_user AND p.id_img = l.id_img ORDER BY UNIX_TIMESTAMP(date) DESC";

    $res = $db->query($sql);
    $data = array();
    $i = 0;
    while ($req = $res->fetch())
    {
        if ($req['id_user'] != $id_profile)
        {
          $data[$i] = array('id_user' => $req['id_user'], 'id_img' => $req['id_img'], 'text' => $req['text'],'date' => $req['date'], 'active' => $req['active'], 'login' => $req['login'], 'profile' => $req['profile'],'img' => $req['img']);
         $i++;
        }
    }  
    $db = null;
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
    $db = null;
    return ($count);
}

if (isset($_SESSION['login']))
{
    $profile = get_profile($_SESSION['login']);
    if ($_GET['action'] == 'notif')
    {
        $db = db_connect();
        $sql = "UPDATE comments c, likes l SET c.active = '0', l.active = '0' WHERE c.id_profile= '".$profile['id']."' AND l.id_profile = '".$profile['id']."'";
        $db->query($sql);
        $db = null;
        $res[0] = 2;
    }
    else if ($_GET['action'] == 'logout')
    {
        session_destroy();
        $res[0] = 3;
    }
    else 
    {
        $res[0] = 1;
        $data = get_notification($profile['id']);
        $res[1] = $data;
        $res[2] = count_notification($profile['id']);
    }
}
else
    $res[0] = 0;
echo json_encode($res);