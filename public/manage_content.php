<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<?php 
	if(isset($_GET["subject"])){
		$selected_subject_id = $_GET["subject"];
		$selected_page_id = null;
	} elseif (isset($_GET["page"])){
		$selected_subject_id = null;
		$selected_page_id = $_GET["page"];
	} else{
		$selected_subject_id = null;
		$selected_page_id = null;
	}
 ?>
	<div id="main">
		<div id="navigation">
			<?php echo navigation($selected_subject_id, $selected_page_id); ?>
		</div>
		<div id="page">
			<h2>Manage Contents</h2>
			<p><?php echo  "Subject ID: ".$selected_subject_id;  ?></p>
			<p><?php echo  "Page ID: ".$selected_page_id;  ?></p>
		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>