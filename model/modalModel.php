<?php

function get_profile_img($id_img)
{
	$db = db_connect();
	$sql = "SELECT id FROM picture Join user WHERE picture.id_user = user.id AND picture.id_img = '".$id_img."'";
	$profile_id = $db->query($sql);
	$profile_id = $profile_id->fetch();

	return $profile_id;

}

function add_comment($login, $comment, $id_img)
{
	$db = db_connect();
	$data = get_profile($login);
	$user_id = $data['id'];

	$profile_id = get_profile_img($id_img);

	$sql = $db->prepare("INSERT INTO comments (id_user, id_profile, id_img, text) VALUES ('".$user_id."', '".$profile_id['id']."','".$id_img."', :text)");
	$sql->bindParam("text", $comment, PDO::PARAM_STR);
	$sql->execute();
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
		$sql = "INSERT INTO likes (id_user, id_profile, id_img) VALUES ('".$user_id."', '".$profile_id['id']."', '".$id_img."')";
		ft_notification($id, $login, "", "like");
	}
	else
		$sql = "DELETE FROM likes WHERE id_user ='".$user_id."' AND id_img = '".$id_img."'";
	$db->query($sql);
}

function check_like($id_user, $id_img)
{
	$db = db_connect();
	$sql = "SELECT * FROM likes WHERE id_user ='".$id_user."' AND id_img = '".$id_img."'";
	$req = $db->query($sql);
	$req = $req->fetch() ;
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
}

?>