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
<script>
	ajax("model/getGallery.php?page="+"<?php echo $page;?>", "gallery");
</script>
<script src="./public/js/gallery.js"></script>
<script src="./public/js/modal.js"></script>
<script src="./public/js/addModal.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
