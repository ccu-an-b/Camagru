<?php ob_start(); ?>
	<h2>Galerie Photos</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">
		<!-- Photo Gallery -->	
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


<script>
	ajax("model/getGallery.php?page="+"<?php echo $page;?>", "gallery");
</script>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
