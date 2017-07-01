<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<?php findSelectedSubject_Page(); ?>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($current_subject, $current_page); ?>
		</div>
		<div id="page">
			<h2>Manage Contents</h2>
			<?php 
				if (isset($current_subject)){
					echo "<p>Subject Name: ". $current_subject["menu_name"] ."</p>";
				} elseif (isset($current_page)) {
					echo "<p>Page Name: ". $current_page["menu_name"] ."</p>";
				} else {
					echo "<p>please select</p>";
				}

			?>

		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>