<?php ob_start(); ?>
<?php $profile = $profile->fetch(); ?>

	<table id="profile">
		<tr>
			<td rowspan="3" style="width:40%"><img src='<?= $profile['profile'] ?>' /></td>
			<td colspan="2" class="login"><?= $profile['login'] ?></td>
			<td><input onclick="window.location.href='./modify_profile.php'" type="button" value="Modifier le profil"></td>
		</tr>
		<tr>
			<td style="width:20%" ><b><?= $count_picture ?></b> Publications</td>
			<td style="width:20%; margin-left: 10px"><b><?= $count_like ?></b> Likes</td>
			<td style="width:20%"><b><?= $count_comment ?></b> Commentaires</td>
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
			<div id='info'> <p> <?= $data['like'] ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= $data['comment'] ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
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
      	<tr>
      		<td id="like" style="width:10px; text-align:center" ></td>
      		<td id="like_img" ><img src="./public/icons/like_on.png"></td>
      		<td id="date"></td>
      		
      	</tr>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
      	<tr>
      		<td colspan="3"><input type="text" placeholder="Ajouter un commentaire..."></td>
      	</tr>
    </table>
    </div>
  </div>

</div>

<script src="./public/js/modal.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
