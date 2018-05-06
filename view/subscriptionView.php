<?php ob_start(); ?>
	<h2>S'inscrire</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
			<form action="" method="post"">
				<table>
					<tr>
						<td><p>Inscrivez-vous pour partager et commenter vos photos avec vos amis</p></td>
					</tr>
					<tr>
						<td><hr></td>				
					</tr>
					<tr>
						<td><p style="font-weight:bold; color: #DA2C38"><?= $error ?></p></td>
					</tr>
					<tr>
						<td><input type="text" name="login" placeholder="Nom d'utilisateur"></td>
					</tr>
					<tr>
						<td><input type="text" name="mail" placeholder="Adresse e-mail"></td>
					</tr>
					<tr>
						<td><input type="password" name="passwd" placeholder="Mot de passe"></td>
					</tr>
					<tr>
						<td><input type="password" name="passwd2" placeholder="Réentrez le mot de passe"></td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" value="S'inscrire"</td>
					</tr>
				</table>
			</form>
			<br/>
		</div>
		<br />
		<div>
			<p>Vous avez d&eacuteja un compte ? <a href="connexion.php">Connectez-vous</a></p>
		</div>
	</div>
	<br />
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>