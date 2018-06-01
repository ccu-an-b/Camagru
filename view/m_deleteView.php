<?php ob_start(); ?>
<table id ="content">
<form action="" method="post">
		<tr>
			<td rowspan="2" id="col1"><img src='<?= $profile['profile'] ?>' /></td>
			<td rowspan="2" class="login"><?= $profile['login'] ?></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><span style="color: #F05D5E">Attention la suppression de votre compte est définitive !</span></td>
			<td></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1">Entrez votre mot de passe</td>
			<td><input type="password" name="passwd"></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input type="submit" name="submit" value="Supprimer le compte"> </td>
		</tr>
		<tr><td><br/></td></tr>
</form>
</table>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>