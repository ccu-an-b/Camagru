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


<div id="myModal" class="modal">

  <span class="close">&times;</span>
  <div class="modal-content">
    <div class="modal-body">
    <span id="div_imgModal"></span>
	<table id ="modal_info">
    	<tr>
      		<td rowspan="2" colspan="2" style="width:20%"><a href="#" id="link_log" ><img id="img_log" src=""/></a></td>
			<td rowspan="2" class="login" id="name_log"></td>
      	</tr>
      	<tr><td></td></tr>
		<tr id="div_comment">
      		<td colspan="3"><hr></td>
      	</tr>
      	<tr><td></td></tr>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
		<tr>
		  	<input type='hidden' name='id' id='id_img' value="0">
      		<td id="like"></td>
      		<td id="like_img" ><img onclick="<?php if (isset($_SESSION['login'])) echo "like()"; else echo "notLog()";?>" id="like_img_2" src="./public/icons/like_on.png"></td>
      		<td id="date"></td>
      	</tr>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
      	<tr>
      		<td colspan="3"><input type="text" id="new_com" name="comment" placeholder="Ajouter un commentaire..."></td>
		</tr>
		<tr>
		<td><input style="opacity:0" type="submit" name="submit" id="submit" onclick="<?php if (isset($_SESSION['login'])) echo "comment()"; else echo "notLog()";?>" value="valider"></td>
		</tr>
    </table>
    </div>
  </div>

</div>
<script src="./public/js/gallery.js"></script>
<script>
	var get  = '<?php if (isset($_GET['user']) && $_GET['user'] != $_SESSION['login']) echo 1; else echo 0 ?>';
	if (get == 0)
		document.getElementById('modify_profile').style.visibility = "visible";
	ajax("model/getGallery.php?user="+"<?php echo $login;?>", "gallery"); 
	show_modal("<?php if(isset($_POST['img'])) echo $_POST['img']; else echo "none"?>");
</script>
<script src="./public/js/modal.js"></script>
<script src="./public/js/addModal.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
