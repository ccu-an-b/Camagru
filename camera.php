<?php

session_start();

require ('model/CamagruModel.php');
include ("config/database.php");

date_default_timezone_set('Europe/Paris');
$jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
$today = jddayofweek($jd,1);

$db = db_connect();
$sql = "SELECT * FROM sticker WHERE date='0'";
$data = $db->query($sql);

$db = db_connect();
$sql = "SELECT * FROM sticker WHERE date='1' AND img_stickers='./public/stickers/".$today.".png'";
$day = $db->query($sql);
$day = $day->fetch();

require('view/cameraView.php');

?>