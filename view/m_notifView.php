<?php ob_start(); ?>
		<tr>
			<td rowspan="2" id="col1"><img src='<?= $profile['profile'] ?>' /></td>
			<td rowspan="2" class="login"><?= $profile['login'] ?></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><b>Nouveau commentaire</b></textarea></td>
		</tr>
		<tr>
			<td id="col1"><input type="checkbox" name="notif_cmt" value="1" id="notif_cmt"></td>
			<td>Recevoir une notification par mail</textarea></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><b>Nouveau like</b></textarea></td>
		</tr>
		<tr>
			<td id="col1"><input type="checkbox" name="notif_like" value="1" id="notif_like"></td>
			<td>Recevoir une notification par mail</textarea></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input type="submit" name="submit" value="Valider" onclick="modify_notification()"> </td>
		</tr>
		<tr><td><br/></td></tr>

<script>
	var notif_cmt = <?php echo $profile['notif_cmt']; ?>;
	if (notif_cmt == 1)
		document.getElementById("notif_cmt").checked = true;
	else if (notif_cmt == 0)
		document.getElementById("notif_cmt").checked = false;

	var notif_like = <?php echo $profile['notif_like']; ?>;
	if (notif_like == 1)
		document.getElementById("notif_like").checked = true;
	else if (notif_like == 0)
		document.getElementById("notif_like").checked = false;

</script>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>