<?php ob_start(); ?>
	<h2>Galerie Photos</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">

<!-- Photo Gallery -->	
<?php
	while ($data = $gallery->fetch()) {
?>

	<div class="img" id= "img" title=<?= $data['id_img'] ?> >
		<div id='info'> <p> <?= get_count($data['id_img'],"id_img", 'likes') ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= get_count($data['id_img'],"id_img", 'comments') ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
		<img src='<?= $data['img'] ?>' />
	</div>
<?php
	}
?>

	</div>
	<br />

<!-- Pagination -->	
	<div id='pagination'>
<?php
	if ($page > 1):
?>
	<a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — 

<?php
	endif;

	if ($page_count > 10 && $page > 4):
?>
	<a href="?page=1">1</a>  ... 

<?php
	endif;

	if ($page_count < 8)
	{
		$start = 1;
		$end = $page_count;
	}
	
	else if ($page >= $page_count - 3)
	{
		$diff = $page_count - $page;
		$start = $page_count - 6 ;
		$end = $page_count;
	}
	else if ($page < 4)
	{
		$start = 1;
		$end = 7;
	}
	else if ($page > 3)
	{
		$start = $page - 3;
		$end = $page + 3;
	}

	for ($i = $start; $i <= $end; $i++):
?>
	<a <?php page_style($i, $page);?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> 

<?php
	endfor;

	if ($page_count > 10 && $page < ($page_count - 3)):
?>
	... <a href="?page=<?php echo $page_count; ?>"><?php echo $page_count; ?></a> 

<?php
	endif;

	if ($page < $page_count):
?>
	— <a href="?page=<?php echo $page + 1; ?>">Page suivante</a>

<?php
	endif;
?>
	</div>
	<br/>

<div id="myModal" class="modal">
	
	<span class="close">&times;</span>
	<div class="modal-content">
	<div class="modal-body">
		<span id="div_imgModal"></span>
		<table id ="modal_info">
			<tr>
				<td rowspan="2" colspan="2" style="width:20%"><img id="img_log" src='<?= $profile['profile'] ?>' /></td>
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
				<td id="like_img" ><img src="./public/icons/like_on.png" onmouseover="this.src='./public/icons/like_on_2.png'" onmouseout="this.src='./public/icons/like_on.png'"></td>
				<td id="date"></td>
			</tr>
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
