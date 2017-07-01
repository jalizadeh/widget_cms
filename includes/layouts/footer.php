	
	<div id="footer">
		Copyright by Javad Alizadeh <?php echo date("Y/M/D"); ?>
	</div>
</body>
</html>

<?php 
	// close tthe connection
	if(isset($connection)){
		mysqli_close($connection);
	}
 ?>