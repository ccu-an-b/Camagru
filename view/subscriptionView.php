<?php ob_start(); ?>
	<h2>S'inscrire</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="connexion">
		<div>
			<br/>
			<form action="" method="post">
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
						<td><input id="password" type="password" name="passwd" placeholder="Mot de passe"></td>
					</tr>
					<tr>
						<td id="pass_security" style="display:none; text-align:left; padding-left:10%;">Votre mot de passe doit contenir :<br/>
							- au minimum 8 caract&egrave;res<br/>
							- un chiffre<br/>
							- une majuscule et une minuscule</td>
					</tr>
					<tr>
						<td><input type="password" name="passwd2" placeholder="Confirmation de mot de passe"></td>
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
			<p>Vous avez d&eacute;j&agrave; un compte ? <a href="connexion.php">Connectez-vous</a></p>
		</div>
	</div>
	<br />

<script src="./public/js/connect.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>