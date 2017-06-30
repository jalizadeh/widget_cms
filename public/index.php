<?php  require_once("../includes/db_connection.php"); ?>
<?php  require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>

	<div id="main">
		<div id="navigation">
			&nbsp;
		</div>
		<div id="page">
			<h2>Homepage</h2>
			<p>Welcome home buddy.</p>
			<ul>
				<li><a href="manage_content.php">Manage Website  Content</a></li>
				<li><a href="manage_admins.php">Manage Amdin Users</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div><!-- end div main -->

<?php  include("../includes/layouts/footer.php"); ?>
