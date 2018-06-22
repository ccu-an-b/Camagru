<?php ob_start(); ?>
	<table>
		<tr>
			<td rowspan="2" id="col1"><img src='<?= $profile['profile'] ?>' /></td>
			<td class="login"><?= $profile['login'] ?></td>
		</tr>
		<tr>
			<td>
			<form id="file-form" method="post" enctype="multipart/form-data">
			<label for="fileToUpload" >modifier la photo de profil</label>
			<input style="display: none" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="fileName()">
			<span id="file_name"></span>
			</br>
    		<input type="submit" style="width:140px" value="Valider" name="Modifier">
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
			<td><input class="input" type="text" name="login" value="<?= $profile['login' ]?>"> <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr>
			<td id="col1">Adresse mail</td>
			<td><input class="input" type="text" name="mail" value="<?= $profile['mail']?>">  <span style="font-weight:bold; color: #DA2C38"><?= $field ?></span></td>
		</tr>
		<tr><td><br/></td></tr>
		<tr>
			<td id="col1"></td>
			<td><input id="submit_form" type="submit" name="submit" onclick="modify_profile()" value="Modifier"> </td>
		</tr>
</table>

<script>

	var form = document.getElementById('file-form');
	var fileSelect = document.getElementById('fileToUpload');

	form.onsubmit = function(event) {
  		event.preventDefault();
		var files = fileSelect.files;
		var formData = new FormData();

		if (files[0])
		{
			formData.append('fileToUpload', files[0], files[0].name);
			ajax_file("account", formData, "model/upload.php?page=account"); 
		}
	}

</script>

<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>

