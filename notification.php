<?php

session_start();

include ("model/CamagruModel.php");

$profile = get_profile($_SESSION['login']);

function get_notification($id_profile)
{
    $db = db_connect();
    $sql = "SELECT id_user AS id_user , id_img AS id_img, text AS text, date AS date, active AS active FROM comments WHERE id_profile='".$id_profile."' UNION ALL SELECT id_user AS id_user , id_img AS id_img, NULL AS text, date AS date, active AS active FROM likes WHERE id_profile ='".$id_profile."' ORDER BY UNIX_TIMESTAMP(date) DESC";
    $notif = $db->query($sql);

    return ($notif);
}

echo $profile['id'];
$res = array();
$res = get_notification($profile['id']);
$res = $res->fetch();
echo json_encode($res);