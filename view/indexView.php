<?php ob_start(); ?>
	<h2>Galerie Photos</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">
	
<?php
	while ($data = $gallery->fetch()) {
?>

    <div class="myBtn" id='img' title='<?= $data['img'] ?>'>
		<div id='info'> <p> <?= $data['like'] ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= $data['comment'] ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
			<img src='<?= $data['img'] ?>' />
		</div>

<?php
	}
?>

	</div>
	<br />
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

<!-- The Modal -->
<div id="myModal" class="modal">
	<span class="close">&times;</span>
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-body">
      <img id="imgModal">
      <p style="float: right">Test</p>
      <p style="float: right">Test</p>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementsByClassName("myBtn");

var i;
for(i = 0 ; i < btn.length ; i++)
{
	var modalImg = document.getElementById("imgModal");
// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
	btn[i].onclick = function() {
   		modal.style.display = "block";
   		modalImg.src = this.title;
	}

// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
   	 modal.style.display = "none";
	}

// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
    	}
	}
}
</script>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
