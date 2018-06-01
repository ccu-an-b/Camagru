<?php ob_start(); ?>
	<h2>Se connecter</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
			<form action="" method="post">
				<table>
					<tr>
						<td><p style="font-weight:bold; color: #DA2C38"><?= $error ?></p></td>
					</tr>
					<tr>
						<td><input type="text" name="login" placeholder="Nom d'utilisateur"></td>
					</tr>
					<tr>
						<td><input type="password" name="passwd" placeholder="Mot de passe"></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="Se connecter"</td>
					</tr>
					<tr>
						<td><br/><hr></td>				
					</tr>
					<tr>
						<td><p><a href=##>Mot de passe oubli&eacute; ?</a></p></td>
					</tr>
				</table>
			</form>
			<br/>
		</div>
		<br />
		<div>
			<p>Vous n'avez pas de compte ? <a href="subscription.php">Inscrivez-vous</a></p>
		</div>
	</div>
	<br />
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>