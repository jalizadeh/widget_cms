<?php  require_once("../includes/session.php"); ?>
<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<?php findSelectedSubject_Page(); ?>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($current_subject, $current_page); ?>
			<a href="new_subject.php">+ Add a new subject</a>
		</div>
		<div id="page">
			<?php 
				// show the session message, then clear it
				echo sessionMessage(); 
				clearSM(); 
			?>
			<h2>Manage Contents</h2>
			<?php 
				// show me the details of the clicked item
				if (isset($current_subject)){
					echo "<p>Subject Name: ". $current_subject["menu_name"] ."</p>";
					echo "<a href=\"edit_subject.php?subject=".$current_subject["id"]."\">Edit subject</a>";
				} elseif (isset($current_page)) {
					echo "<p>Page Name: ". $current_page["menu_name"] ."</p>";
				} else {
					echo "<p>please select</p>";
				}

			?>

		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>