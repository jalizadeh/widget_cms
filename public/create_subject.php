<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>



<?php 
	// protect this page from direct access, only must be accessed through new_subject.php
	if(isset($_POST["submit"])){
		$menu_name = mysqli_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (bool) $_POST["visible"];

		$query = "INSERT INTO subjects (menu_name, position, visible) VALUES ('{$menu_name}', '{$position}', '{$visible}')";
		$result = mysqli_query($connection, $query);

		if($result){
			redirectTo("manage_content.php");
		} else {
			//redirectTo("new_subject.php");
			echo "naaaa";
		}

	} else {
		//redirectTo("new_subject.php");
		echo "noch";
	}
		
 ?>
	
	




<?php 
	if(isset($connection)){
		mysqli_close($connection);
	}
 ?>