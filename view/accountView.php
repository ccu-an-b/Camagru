<?php ob_start(); ?>

	<h2>Votre compte</h2>
	<hr id="hr_title"/>
	<br/>
	<p style="font-weight:bold; color: #DA2C38; text-align:center"><?= $error ?></p>
	<div id="account">
	<table id="category">
		<tr onclick="callback_account(1)">
			<td class="page"></td>
			<a><td>Modifier le profil</td></a>
		</tr>
		<tr onclick="callback_account(2)">
			<td class="page"></td>
			<a><td >Changer le mot de passe</td></a>
		</tr>
		<tr onclick="callback_account(3)">
			<td class="page"></td>
			<a><td >Notifications</td></a>
		</tr>
		<tr onclick="callback_account(4)">
			<td class="page"></td>
			<a><td >Gérer les photos</td></a>
		</tr>
		<tr onclick="callback_account(5)">
			<td class="page"></td>
			<a><td >Supprimer le compte</td></a>
		</tr>
	</table>
	<div id="content">
	<?= $form ?>
	</div>
	<br/>
<script src="./public/js/account.js"></script>
<script>
	var page = <?= $_GET['page']?>;
	var page_link = document.getElementsByClassName("page");
	page_link[page - 1].style.backgroundColor= "#4B4453";
</script>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
