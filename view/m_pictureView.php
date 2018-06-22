<?php ob_start(); ?>
<?php
	$i = 0;
	
	while ($data = $picture->fetch())
	{
	?>	
		<td>

			<input class="input" class="del_img" type="image" name="img[]" src='<?= $data['img'] ?>' alt="<?= $data['id_img'] ?>" value="0"/>
		</td>
	<?php

		$i++;
	}
	if ($i == 0)
	{
		echo "<p style='color:red'>Vous n&#39;avez pas encore pris de photos</p>";
	}
	else 
	{
		echo "</br><input onclick='modify_picture()' style='margin-left:60px; width:150px;' type='submit' name='submit' id='submit_form' value='Supprimer'>";
	}
	$picture->closeCursor();
?>

<script>
	var img = document.getElementsByClassName("del_img");

    var i;
    for(i = 0 ; i < img.length ; i++)
    {    
        img[i].onclick = function() {
			if (this.value == 1)
			{
				this.value = 0 ;
				this.style.borderColor = "rgba(255, 255, 255, 0)"
			}
			else
			{
				this.value = 1 ;
				this.style.borderColor = "#EF626C"
			}		
        }
    }
</script>

<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>