<?php ob_start(); ?>
<table id="content">
<form action="" method="post">
<?php
	$i = 0;
	while ($data = $picture->fetch())
	{
		if ( $i == 0 || $i%3 == 0)
			echo "<tr>";
	?>	
		<td>
			<img src='<?= $data['img'] ?>' />
			<input type="checkbox" name="<?= $data['id'] ?>" value="yes"/>
		</td>
	<?php
		if ($i == 0 || $i%3 == 0)
			echo "</tr>";
		$i++;
	}
	$picture->closeCursor();
?>
</form>
</table>
<?php $form = ob_get_clean(); ?>

<?php require('view/accountView.php'); ?>