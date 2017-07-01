<?php  require_once("../includes/session.php"); ?>
<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>

<?php 
	$current_subject = findSelectedSubjectById($_GET["subject"]);

	if(!$current_subject){
		$_SESSION["message"] = "no subject with this id found.";
		redirectTo("manage_content.php");
	}

	$query = "DELETE FROM subjects 
				 WHERE id = '{$current_subject["id"]}'
				 LIMIT 1";
	$result = mysqli_query($connection, $query);

	if($result && mysqli_affected_rows($connection) ==1){
		$_SESSION["message"] = "Subject successfully deleted.";
		redirectTo("manage_content.php");
	} else {
		$_SESSION["message"] = "Error.";
		redirectTo("manage_content.php");
	}		
 ?>
