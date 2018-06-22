<?php ob_start(); ?>
	<table>
		<tr>
			<td rowspan="2" id="col1"><img src='<?= $profile['profile'] ?>' /></td>
			<td rowspan="2" class="login"><?= $profile['login'] ?></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1">Ancien mot de passe</td>
			<td><input class="input" type="password" name="old_pass"> <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1">Nouveau mot de passe</td>
			<td><input class="input" type="password" name="new_pass">  <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1">Confirmer le nouveau mot de passe</td>
			<td><input class="input" type="password" name="new_pass_2"> <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input onclick="modify_passwd()" type="submit" name="submit" id="submit_form" value="Modifier le mot de passe"> </td>
		</tr>
	</table>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>