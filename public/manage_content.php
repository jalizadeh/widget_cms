<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<?php findSelectedSubject_Page(); ?>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($selected_subject_id, $selected_page_id); ?>
		</div>
		<div id="page">
			<h2>Manage Contents</h2>

		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>