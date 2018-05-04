<?php ob_start(); ?>
	<h2>Se connecter</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<p>Test</p>
		</div>
		<br />
		<div>
			<p>Vous n'avez pas de compte ? <a href=#>Inscrivez-vous</a></p>
		</div>
	</div>
	<br />

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>