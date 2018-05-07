<?php ob_start(); ?>

	<h2>Votre compte</h2>
	<hr id="hr_title"/>
	<br/>
	<p style="font-weight:bold; color: #DA2C38; text-align:center"><?= $error ?></p>
	<div id="account">
	<table id="category">
		<tr>
			<td><a <?= $page0 ?> href="modify_profile.php">Modifier le profil</a></td>
		</tr>
		<tr>
			<td><a <?= $page1 ?> href="modify_passwd.php">Changer le mot de passe</a></td>
		</tr>
		<tr>
			<td><a <?= $page2 ?> href="modify_notif.php">Notifications</a></td>
		</tr>
		<tr>
			<td><a <?= $page3 ?> href="modify_picture.php">Gérer les photos</a></td>
		</tr>
		<tr>
			<td><a <?= $page4 ?> href="modify_delete.php">Supprimer le compte</a></td>
		</tr>
	</table>
	
	<?= $form ?>
	
	</div>
	<br/>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
