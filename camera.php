<?php

session_start();

require('model/CamagruModel.php');
include ("config/database.php");
include ("model/cameraModel.php");

if(empty($_SESSION['login']))
    header('Location: index.php');

date_default_timezone_set('Europe/Paris');
$jd = cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
$today = jddayofweek($jd,1);

$stickers = get_stickers();

$day = get_day($today);

require('view/cameraView.php');

?>