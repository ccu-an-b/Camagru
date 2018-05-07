<?php ob_start(); ?>
	<h2>Galerie Photos</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">
	<?php
	while ($data = $gallery->fetch())
	{
	?>
		<div id='img'>
			<div id='info'> <p> <?= $data['like'] ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= $data['comment'] ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
			<img src='<?= $data['img'] ?>' />
		</div>
	<?php
	}
	$gallery->closeCursor();
	?>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
