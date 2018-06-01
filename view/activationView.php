
<?php ob_start(); ?>
	<h2>Activation de votre compte</h2>
	<hr id="hr_title"/>
	<br/>
	<p style="font-weight:bold; color: #DA2C38; text-align:center"><?= $error ?></p>
	<div id="connexion">
	<p><a id="connexion" href="connexion.php">Connectez-vous</a></p>
	<br/>
	</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>