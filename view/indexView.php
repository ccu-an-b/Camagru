<?php ob_start(); ?>
	<h2>Galerie Photos</h2>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">

<!-- Photo Gallery -->	
<?php
	while ($data = $gallery->fetch()) {
?>

    <div class="myBtn" id='img' title='<?= $data['id_img'] ?>'>
		<div id='info'> <p> <?= $data['like'] ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= $data['comment'] ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
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

<!-- Images Modal -->
<div id="myModal" class="modal">
	<span class="close">&times;</span>
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-body">
      <span id="div_imgModal"></span>
      <p style="float: right">Test</p>
      <p style="float: right">Test</p>
    </div>
  </div>

</div>

<script>

function showImg(id) {
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('div_imgModal').innerHTML = this.responseText;

            }
        };

        xmlhttp.open("GET","api.php?q="+id,true);
        xmlhttp.send();
    }

var modal = document.getElementById('myModal');

var btn = document.getElementsByClassName("myBtn");

var i;
for(i = 0 ; i < btn.length ; i++)
{
	var modalImg = document.getElementById("imgModal");
	var exit = document.getElementsByClassName("close")[0];

	btn[i].onclick = function() {
   		modal.style.display = "block";

   		var id = this.title;
   		showImg(id);
   		
	}

	exit.onclick = function() {
   	 modal.style.display = "none";
	}

	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
    	}
	}
}


</script>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
