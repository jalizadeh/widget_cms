<?php  require_once("../includes/session.php"); ?>
<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<?php findSelectedSubject_Page(); ?>

<?php 
	// protect this page from direct access
	// only must be accessed through new_subject.php, first I check the "POST"
	if(isset($_POST["submit"])){
		$id = (int) $current_subject["id"];
		$menu_name = mysqli_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (bool) $_POST["visible"];

		$query = "UPDATE subjects 
					SET menu_name = '{$menu_name}' ,
					 position = '{$position}',
					 visible = '{$visible}'
					WHERE id = {$id} 
					 LIMIT 1";
		$result = mysqli_query($connection, $query);

		if($result && mysqli_affected_rows($connection) ==1){
			$_SESSION["message"] = "Subject successfully updated.";
			redirectTo("manage_content.php");
		} else {
			$_SESSION["message"] = "Error.";
			// redirectTo("new_subject.php");
		}

	} 		
 ?>
	
	<div id="main">
		<div id="navigation">
			<?php echo navigation($current_subject, $current_page); ?>
		</div>
		<div id="page">
			<?php  
				// show the session message, then clear it
				echo sessionMessage(); 
				clearSM();
			?>
			<h2>Edit Subjects: <?php echo $current_subject["menu_name"]; ?>
			</h2>
			<hr>
			<form action="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" method="post">
				<p>Subject name:
					<input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"]; ?>">
				</p>
				<p>Position:
					<?php 
						$total_subject_num = mysqli_num_rows(findAllSubjects());
					 ?>
					<select name="position">
						<?php 
							// create the list of positions by the count of "subjects"
							for ($count=1; $count < $total_subject_num ; $count++) { 
								echo "<option value=\"".$count."\"";
								if ($current_subject["position"] == $count) {
									echo " selected  ";
								}
								echo ">".$count."</option>";
							}
						 ?>
					</select>
				</p>
				<p>Visible:
					<input type="radio" name="visible" value="1" 
					<?php if ($current_subject["visible"]) {
							echo "checked";
						}
					 ?>
					/> Yes 
					&nbsp;
					<input type="radio" name="visible" value="0"
					<?php if (!$current_subject["visible"]) {
							echo "checked";
						}
					 ?>
					/> No
				</p>
				<input type="submit"  name="submit" value="Save Edits">
			</form>
			<br>
			<a href="manage_content.php">Cancel</a>
			&nbsp;
			&nbsp;
			<a href="delete_subject.php?subject=<?php echo $current_subject["id"]; ?>" onclick="return confirm('Are you sure?')" >Delete subject</a>
		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>