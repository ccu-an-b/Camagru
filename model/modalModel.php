<?php

function get_profile_img($id_img)
{
	$db = db_connect();
	$sql = "SELECT id FROM picture Join user WHERE picture.id_user = user.id AND picture.id_img = '".$id_img."'";
	$profile_id = $db->query($sql);
	$profile_id = $profile_id->fetch();
	$db = null;
	return $profile_id;
}
 
function add_comment($login, $comment, $id_img)
{
	$db = db_connect();
	$data = get_profile($login);
	$user_id = $data['id'];
	$profile_id = get_profile_img($id_img);
	$active = '1';
	$comment = htmlspecialchars($comment);
	if ($profile_id['id'] == $user_id)
		$active = '0';
	$sql = $db->prepare("INSERT INTO comments (id_user, id_profile, id_img, text, active) VALUES ('".$user_id."', '".$profile_id['id']."','".$id_img."', :text,'".$active."')");
	//$sql->bindParam("text", $comment, PDO::PARAM_STR);
	$sql->execute(array( ':text' => $comment));
	$sql->closeCursor();
	ft_notification($id_img, $login, $comment, "commentaire");
}

function add_like($login, $id_img)
{
	$db = db_connect();
	$data = get_profile($login);

	$user_id = $data['id'];
	if (!check_like($user_id, $id_img))
	{
		$profile_id = get_profile_img($id_img);
		$active = '1';
		if ($profile_id['id'] == $user_id)
			$active = '0';
		$sql = "INSERT INTO likes (id_user, id_profile, id_img, active) VALUES ('".$user_id."', '".$profile_id['id']."', '".$id_img."','".$active."')";
		ft_notification($id_img, $login, "", "like");
	}
	else
		$sql = "DELETE FROM likes WHERE id_user ='".$user_id."' AND id_img = '".$id_img."'";
	$db->query($sql);
	$db = null;
}

function check_like($id_user, $id_img)
{
	$db = db_connect();
	$sql = "SELECT * FROM likes WHERE id_user ='".$id_user."' AND id_img = '".$id_img."'";
	$req = $db->query($sql);
	$req = $req->fetch() ;
	$db = null;
	if ($req == "")
		return false;
	else
		return true;
}

function ft_notification($id_img, $user, $comment, $item)
{
	$db = db_connect();
	if ($item == "commentaire")
		$index = 'notif_cmt';
	else
		$index = 'notif_like';

	$sql = "SELECT mail, ".$index." ,login FROM picture Join user WHERE picture.id_user = user.id AND picture.id_img = '".$id_img."'";
	$profile = $db->query($sql);
	$profile = $profile->fetch();

	if ($profile[$index] == '1' && ($profile['login'] != $user) )
	{
		$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
		$subjet = "Camagru : Nouveau ".$item."\n";

		$message = "Vous avez un nouveau ".$item." de ".$user.":\n\n";
		if ($item == "commentaire")
			$message .= '"'.$comment.'"';
		$message .="\n"."---------------"."\n";
		$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";

		mail($profile['mail'], $subjet, $message, $header);
	}
	$db = null;
}

?>