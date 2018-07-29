<?php

include ("CamagruModel.php");
include ("../config/database.php");

function resizePic($src, $item)
{
    $Width = 640;
    $Height = 480;
    if ($item == "sticker")
    {
        $img = imagecreatefrompng($src);
        $x1 = 0;
        $y1 = 0;
    }
    else {
        $ext = strstr($src, ".png");
        if ($ext != "")
            $img = imagecreatefrompng($src);
        else
        {
            $img = imagecreatefromjpeg($src);
        }
        $initSize = getimagesize($src);
        $Width = $initSize[0];
        $Height = $initSize[1];
        if ($Width> 320)
        {
           if ($Width > $Height ){
                 $r = $Width / 320;
                 round($r , 0, PHP_ROUND_HALF_DOWN);
            }
            else{
                $r = $Height / 320;
                round($r , 0, PHP_ROUND_HALF_DOWN);
           }
        }
        else 
        {
            $r = 1;
        }
        $centreX = round($Width / 2);
        $centreY = round($Height / 2);
    
        $cropWidthHalf  = round($Width / 2);
        $cropHeightHalf = round($Height / 2);
    
        $x1 = max(0, $centreX - $cropWidthHalf);
        $y1 = max(0, $centreY - $cropHeightHalf);
    }
    

    $newimg = imagecreatetruecolor($Width, $Height);
    imagesavealpha($newimg, true);
    $trans_color = imagecolorallocatealpha($newimg, 0, 0, 0, 127);
    imagefill($newimg, 0, 0, $trans_color);
    imagecopy($newimg, $img, 0, 0, $x1, $y1, $Width, $Height);
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

if (file_exists($target_dir.$new_name.".png")) {
    $i = 1;
    while(file_exists($target_dir.$new_name."(".$i.").png"))
        $i++;
    $new_name = $new_name."(".$i.").png";
}
else
    $new_name = $new_name.".png";

if (empty($_FILES['fileToUpload']))
    $new = imagecreatefrompng($_POST['src']);
else
    $new = resizePic($_FILES["fileToUpload"]["tmp_name"], "pic");

if ($new === false)
    die("<p>Une erreur est survenue.</p>");

imagecopy($new, $_POST['sticker'], 0, 0, 0, 0, imagesx($_POST['sticker']), imagesy($_POST['sticker']));
$new_path = $target_dir.$new_name;
imagepng($new, $new_path);
imagedestroy($new);
add_picture($_SESSION['login'], $new_name);

echo json_encode("public/picture/".$_SESSION['login']."/pictures/".$new_name);

?>