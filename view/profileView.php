<?php ob_start(); ?>

	<table id="profile">
		<tr>
			<td rowspan="3" style="width:40%"><img src='<?= $profile['profile'] ?>' /></td>
			<td colspan="2" class="login"><?= $profile['login'] ?></td>
			<td><input id="modify_profile" onclick="window.location.href='./modify_profile.php'" type="button" value="Modifier le profil"></td>
		</tr>
		<tr>
			<td style="width:20%" ><b><?= $count_picture ?></b> Publications</td>
			<td style="width:20%; margin-left: 10px"><b><?= $count_like ?></b> Likes</td>
			<td style="width:20%"><b><?= $count_cmnt ?></b> Commentaires</td>
		</tr>
		<tr>
			<td colspan="3"><i><?= $profile['bio'] ?></i></td>
		</tr>
	</table>
	<br/>
	<hr id="hr_title"/>
	<br/>

	<div id="gallery">
	</div>

<script>
	var get  = '<?php if (isset($_GET['user']) && $_GET['user'] != $_SESSION['login']) echo 1; else echo 0 ?>';
	if (get == 0)
		document.getElementById('modify_profile').style.visibility = "visible";
	ajax("model/getGallery.php?user="+"<?php echo $login;?>", "gallery"); 
</script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
