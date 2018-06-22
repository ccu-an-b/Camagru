<?php

function get_stickers()
{
    $db = db_connect();
    $sql = "SELECT * FROM sticker WHERE date='0'";
    $data = $db->query($sql);
    return ($data);
}

function get_day($today)
{
    $db = db_connect();
    $sql = "SELECT * FROM sticker WHERE date='1' AND img_stickers='./public/stickers/".$today.".png'";
    $day = $db->query($sql);
    $day = $day->fetch();
    return $day;
}

?>