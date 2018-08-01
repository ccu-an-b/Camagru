<?php ob_start(); ?>

	<!-- Profile Header -->	
	<table id="profile">
		<tr>
			<td rowspan="3" style="width:40%"><img id="profile_src" src='<?php echo $profile['profile'];?>'/></td>
			<td colspan="2" id="profile_login" class="login"></td>
			<td><input id="modify_profile" onclick="window.location.href='./modify_profile.php?page=1'" type="button" value="Modifier le profil"></td>
		</tr>
		<tr>
			<td id="count_picture"  ></td>
			<td id="count_like" ></td>
			<td id="count_com" ></td>
		</tr>
		<tr>
			<td id="profile_bio" colspan="3"></td>
		</tr>
		<tr>
		<td></td>
		<td colspan="2"><input id="modify_profile_2" onclick="window.location.href='./modify_profile.php?page=1'" type="button" value="Modifier le profil"></td>
		</tr>
	</table>

	<br/>
	<hr id="hr_title" class="profile"/>
	<br/>

	<div id="gallery">
	<!-- Photo Gallery -->	
	</div>

<script>
	var get  = '<?php 
		if ((isset($_GET['user']) && empty($_SESSION['login'])) || (isset($_GET['user']) && $_GET['user'] != $_SESSION['login']))
			echo 1; 
		else 
	 		echo 0; ?>';
	if (get == 0)
	{
		document.getElementById('modify_profile').style.visibility = "visible";
		document.getElementById('modify_profile_2').style.visibility = "visible";
	}
	else
	{
		document.getElementById('modify_profile').style.display = "none";
		document.getElementById('modify_profile_2').style.display = "none";
	}
	ajax("model/getGallery.php?user="+"<?php echo $login;?>", "gallery"); 
</script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
