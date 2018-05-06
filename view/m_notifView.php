<?php ob_start(); ?>
<table id ="content">
<form action="" method="post"">
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
			<td id="col1"><input type="checkbox" name="comment_mail" value="yes" checked></td>
			<td>Recevoir une notification par mail</textarea></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><b>Nouveau like</b></textarea></td>
		</tr>
		<tr>
			<td id="col1"><input type="checkbox" name="like_mail" value="yes" checked></td>
			<td>Recevoir une notification par mail</textarea></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input type="submit" name="submit" value="Valider"> </td>
		</tr>
		<tr><td><br/></td></tr>
</form>
</table>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>