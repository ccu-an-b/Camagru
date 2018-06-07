<?php ob_start(); ?>


	<table id="profile">
		<tr>
			<td rowspan="3" style="width:40%"><img src='<?= $profile['profile'] ?>' /></td>
			<td colspan="2" class="login"><?= $profile['login'] ?></td>
			<td><input onclick="window.location.href='./modify_profile.php'" type="button" value="Modifier le profil"></td>
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
	<?php
	while ($data = $picture->fetch())
	{
	?>
		<div class="img" id= "img" title=<?= $data['id_img'] ?> >
			<div id='info'> <p> <?= get_count($data['id_img'],"id_img", 'likes') ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= get_count($data['id_img'],"id_img", 'comments') ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
			<img src='<?= $data['img'] ?>' />
		</div>
	<?php
	}
	$picture->closeCursor();
	?>
	</div>


<div id="myModal" class="modal">

  <span class="close">&times;</span>
  <div class="modal-content">
    <div class="modal-body">
    <span id="div_imgModal"></span>
	<table id ="modal_info">
    	<tr>
      		<td rowspan="2" colspan="2" style="width:20%"><img id="img_log" src=""/></td>
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
		<form method="GET" action="">
      	<tr>
		  	<input type='hidden' name='id' id='id_like' value="0">
      		<td id="like"></td>
      		<td id="like_img" ><input type="submit" name="like"><img src="./public/icons/like_on.png"></td>
      		<td id="date"></td>
      	</tr>
		</form>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
		<form method="POST" action="">
		<input type='hidden' name='id' id='id_com' value="0">
      	<tr>
      		<td colspan="3"><input type="text" name="comment" placeholder="Ajouter un commentaire..."></td>
		</tr>
		<tr>
		<td><input style="opacity:0" type="submit" name="submit" value="valider"></td>
		</tr>
		</form>
    </table>
    </div>
  </div>

</div>

<script src="./public/js/modal.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
