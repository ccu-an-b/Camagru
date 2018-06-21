<?php

session_start();

include ("CamagruModel.php");
include ("../config/database.php");
include ("accountModel.php");

if ($_GET['page'] == "account" )
{
    $target_dir = "public/picture/".$_SESSION['login']."/profile/";
    $data = 1;
}

$target_dir = "public/picture/".$_SESSION['login']."/profile/";
if (!file_exists($target_dir))
    mkdir($target_dir, 0777, true);

$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
if (file_exists($target_file)) {
    $i = 1;
    $file_name = explode(".".$imageFileType,$target_file );
    while(file_exists($file_name[0]."(".$i.").".$imageFileType))
        $i++;

    $_FILES["fileToUpload"]["name"] = $file_name[0]."(".$i.").".$imageFileType;
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $_SESSION['error'] = "Le fichier t&eacute;l&eacute;charg&eacute; est trop grand.";
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $_SESSION['error'] = "Seuls les fichiers JPG, JPEG, PNG & GIF sont accept&eacutes;.";
}
if (empty($_SESSION['error'])) {
    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION['error'] = "Votre image n&#39;a pas pu &ecirc;tre t&eacute;l&eacute;charg&eacute;e.";
    }
    else if ($_GET['page'] ==  "account")
    {
        ft_mod_profile($_SESSION['login'], $target_file);
    }
}

echo json_encode($data);



?>