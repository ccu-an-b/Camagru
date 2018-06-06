<?php ob_start(); ?>
<table id="content">
<form action="" method="post">
<?php
	$i = 0;
	while ($data = $picture->fetch())
	{
		if ( $i == 0 || ($i % 3) == 0)
			echo "<tr id = ".$i.">";
	?>	
		<td>
			<img src='<?= $data['img'] ?>' />
			<input type="checkbox" name="img[]" value="<?= $data['id_img'] ?>"/>
		</td>
	<?php
		if (($i % 2) == 0 && $i !=0)
			echo "</tr>";
		if ($i == 3)
			$i = 0;
		$i++;
	}
	if ($i == 0)
	{
		echo "<p style='color:red'>Vous n&#39;avez pas encore pris de photos</p>";
	}
	else 
	{
		echo "<tr><td colspan = '3'><input type='submit' name='submit' value='Supprimer'></td></tr>";
	}
	$picture->closeCursor();
?>
</form>
</table>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>