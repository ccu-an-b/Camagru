<?php ob_start(); ?>
	<table >
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
			<td><input class="input" type="password" name="pass"><span style="margin-left:10px;font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input onclick="modify_delete()" type="submit" name="submit" id="submit_form" value="Supprimer le compte"></td>
		</tr>
	</table>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>