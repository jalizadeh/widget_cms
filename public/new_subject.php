<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<?php findSelectedSubject_Page(); ?>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($current_subject, $current_page); ?>
		</div>
		<div id="page">
			<h2>Create Subjects</h2>
			<hr>
			<form action="create_subject.php" method="post">
				<p>Subject name:
					<input type="text" name="menu_name" value="">
				</p>
				<p>Position:
					<?php 
						$total_subject_num = mysqli_num_rows(findAllSubjects());
					 ?>
					<select name="position">
						<?php 
							for ($count=1; $count < ($total_subject_num+1) ; $count++) { 
								echo "<option value=\"".$count."\">".$count."</option>";
							}
						 ?>
					</select>
				</p>
				<p>Visible:
					<input type="radio" name="visible" value="1">
					&nbsp;
					<input type="radio" name="visible" value="0">
				</p>
				<input type="submit"  name="submit" value="Create Subject">
			</form>
			<br>
			<a href="manage_content.php">Cancel</a>
		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>