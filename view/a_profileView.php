<?php ob_start(); ?>
<table id ="content">
<form action="" method="post">
		<tr>
			<td rowspan="2" id="col1"><img src='<?= $profile['profile'] ?>' /></td>
			<td class="login"><?= $profile['login'] ?></td>
		</tr>
		<tr>
			<td>
				<form method="post" action="" >
					<label for="img_file" >modifier la photo de profil</label>
					<input style="display: none" type="file" id="img_file" name="img_file" accept="image/*"/>
				</form>
			</td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1">Bio</td>
			<td><textarea style="height:80px;" type="text" name="bio"><?= $profile['bio']?></textarea></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1">Nom d'utilisateur</td>
			<td><input type="text" name="login" value="<?= $profile['login' ]?>"> <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr>
			<td id="col1">Adresse mail</td>
			<td><input type="text" name="mail" value="<?= $profile['mail']?>">  <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input type="submit" name="submit" value="Modifier"> </td>
		</tr>
		<tr><td><br/></td></tr>
</form>
</table>

<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>

