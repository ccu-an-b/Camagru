<?php ob_start(); ?>
	<h2>Galerie Photos</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">
	
<?php
	while ($data = $gallery->fetch()) {
?>

    <div id='img'>
		<div id='info'> <p> <?= $data['like'] ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= $data['comment'] ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
			<img src='<?= $data['img'] ?>' />
		</div>

<?php
	}
?>

	</div>

<?php
	if ($page > 1):
?>
	<a id="pagination" href="?page=<?php echo $page - 1; ?>">Page précédente</a> — 

<?php
	endif;

	for ($i = 1; $i <= $page_count; $i++):
?>
	<a id="pagination" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> 

<?php
	endfor;

	if ($page < $page_count):
?>
	— <a id="pagination" href="?page=<?php echo $page + 1; ?>">Page suivante</a>

<?php
	endif;
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
