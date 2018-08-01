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
			<td><input id="password" class="input" type="password" name="new_pass">  <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr>
			<td id="col1"></td>
			<td id="pass_security" style="display:none;text-align:left; padding-left:10%; height:auto; font-size:16px">Votre mot de passe doit contenir :<br/>
			- au minimum 8 caract&egrave;res<br/>
			- un chiffre<br/>
			- une majuscule et une minuscule</td>
		</tr>
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

<script>
	var password = document.getElementById("password")
if (password){
    password.addEventListener('input', function(){
        document.getElementById("pass_security").style.display = "block"
    })
}
</script>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>