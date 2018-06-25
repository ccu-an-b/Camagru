<?php

include ("CamagruModel.php");
include ("../config/database.php");

function resizePic($src)
{
    $img = imagecreatefrompng($src);
    $initSize = getimagesize($src);
    $Width = 640;
    $Height = 480;

    $newimg = imagecreatetruecolor($Width, $Height);
    imagesavealpha($newimg, true);
    $trans_color = imagecolorallocatealpha($newimg, 0, 0, 0, 127);
    imagefill($newimg, 0, 0, $trans_color);
    imagecopy($newimg, $img, 0, 0, 0, 0, $Width, $Height);
    imagesavealpha($newimg, true);
    imagedestroy($img);
    return $newimg;
}

function add_picture($login, $src){
    $profile = get_profile($login);
    $src = "public/picture/".$_SESSION['login']."/pictures/".$src;
    $db = db_connect();

    $sql = "INSERT INTO picture (id_user, img) VALUE ('".$profile['id']."', '".$src."')";
    $db->query($sql);
    $db = null;
    return true;

}

session_start();
$profile = get_profile($_SESSION['login']);

$target_dir = "../public/picture/".$_SESSION['login']."/pictures/";

if (!file_exists($target_dir))
    mkdir($target_dir, 0777, true);

$new_name = $_SESSION['login'];
 
$_POST['sticker'] = resizePic($_POST['sticker']);

if (file_exists($target_dir.$new_name.".png")) {
    $i = 1;
    while(file_exists($target_dir.$new_name."(".$i.").png"))
        $i++;
    $new_name = $new_name."(".$i.").png";
}
else
    $new_name = $new_name.".png";

$new = imagecreatefrompng($_POST['src']);

if ($new === false)
    die("<p>Une erreur est survenue.</p>");

imagecopy($new, $_POST['sticker'], 0, 0, 0, 0, imagesx($_POST['sticker']), imagesy($_POST['sticker']));
$new_path = $target_dir.$new_name;
imagepng($new, $new_path);
imagedestroy($new);
add_picture($_SESSION['login'], $new_name);

echo json_encode("public/picture/".$_SESSION['login']."/pictures/".$new_name);

?>