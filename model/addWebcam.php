<?php

include ("CamagruModel.php");
include ("../config/database.php");

function resizePic($src, $item)
{
    $width = 640;
    $height = 480;
    $x = 0;
    $y = 0;

    switch($item) {
        case "png" :
            $img = imagecreatefrompng($src);
            break;
        case "jpg" :
            $img = imagecreatefromjpeg($src);
            break;    
        case "gif" :
            $img = imagecreatefromgif($src);
            break;
        case "sticker":
            $img = imagecreatefrompng($src);
            break;
    }

    $dimensions = getimagesize($src);

    if($dimensions[0] > ($width / $height) * $dimensions[1]){
        $dimY = $height;
        $dimX = round($height * $dimensions[0] / $dimensions[1]);
        $x = ($dimX - $width) / 2;
    }
    if($dimensions[0] < ($width / $height) * $dimensions[1]){
        $dimX = $width;
        $dimY = round($width * $dimensions[1] / $dimensions[0]);
        $y = ($dimY - $height) / 2;
    }
    if($dimensions[0] == ($width / $height) * $dimensions[1]){
        $dimX = $width;
        $dimY = $height;
    }
    
    $newimg = imagecreatetruecolor($width, $height);
    imagesavealpha($newimg, true);
    $trans_color = imagecolorallocatealpha($newimg, 0, 0, 0, 127);
    imagefill($newimg, 0, 0, $trans_color);
    imagecopyresampled($newimg, $img,0, 0, $x, $y, $dimX, $dimY, $dimensions[0], $dimensions[1]);
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
 
$_POST['sticker'] = resizePic($_POST['sticker'], "sticker");

if (empty($_FILES['fileToUpload']))
{
    $new = imagecreatefrompng($_POST['src']);
    $fileType = "png";
}
else
{
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $new = resizePic($_FILES["fileToUpload"]["tmp_name"], $fileType);
}

if (file_exists($target_dir.$new_name.".".$fileType)) {
    $i = 1;
    while(file_exists($target_dir.$new_name."(".$i.").".$fileType))
        $i++;
    $new_name = $new_name."(".$i.").".$fileType;
}
else
    $new_name = $new_name.".".$fileType;

if ($new === false)
    die("<p>Une erreur est survenue.</p>");

imagecopy($new, $_POST['sticker'], 0, 0, 0, 0, imagesx($_POST['sticker']), imagesy($_POST['sticker']));
$new_path = $target_dir.$new_name;
if ($fileType == "png")
    imagepng($new, $new_path);
else if ($fileType == "jpg")
    imagejpeg($new, $new_path);
else if ($fileType == "gif")
    imagegif($new, $new_path);

imagedestroy($new);
add_picture($_SESSION['login'], $new_name);

echo json_encode("public/picture/".$_SESSION['login']."/pictures/".$new_name);

?>