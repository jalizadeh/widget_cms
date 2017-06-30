<?php 

function confirmQuery($result){
	if(!$result){
		die("Database query failed.");
	}
}


function findAllSubjects(){
	global  $connection;

	$query = "SELECT * FROM subjects 
				WHERE visible = 1 
				ORDER BY position ASC";

	$subject_q = mysqli_query($connection, $query);
	confirmQuery($subject_q);
	return $subject_q;
}


// find list of pages based on Subject ID
function  findPagesForSubject($subject_id){
	global $connection;

	$query = " SELECT * FROM pages
				 WHERE subject_id = {$subject_id}
				 AND visible = 1
				 ORDER BY position ASC";
	$pages_q = mysqli_query($connection, $query);
	confirmQuery($pages_q);
	return $pages_q;
}


function findSelectedSubjectById($subject_id){
	global $connection;

	$safe_id = mysqli_real_escape_string($connection,$subject_id);
	$query = "SELECT * FROM subjects
				 WHERE id = {$safe_id}
				 LIMIT 1";
	$subject_set = mysqli_connect($connection, $query);
	confirmQuery($subject_set);
	if ($subject = mysqli_fetch_assoc($subject_set)){
		return $subject;
	} else {
		return null;
	}
}

function findSelectedPageById($page_id){
	global $connection;

	$safe_id = mysqli_real_escape_string($connection,$page_id);
	$query = "SELECT * FROM pages
				 WHERE id = {$safe_id}
				 LIMIT 1";
	$page_set = mysqli_connect($connection, $query);
	confirmQuery($page_set);
	if ($page = mysqli_fetch_assoc($page_set)){
		return $page;
	} else {
		return null;
	}
}


function findSelectedSubject_Page(){
	global $selected_subject_id;
	global $selected_page_id;

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
}


// it shows the navigation menu
// also puts bullet beside the selected subject/page
function navigation($subject_id, $page_id){
	$output = "<ul class=\"subjects\">";
	$subjects = findAllSubjects();
	while($subject_f = mysqli_fetch_assoc($subjects)){
		$output .= "<li ";
		// check to find the selected subject
		if($subject_f["id"] == $subject_id ){
			$output .= "class=\"selected\"";
		} 
		$output .= ">";
		$output .= "<a href=\"manage_content.php?subject=".urlencode($subject_f["id"])."\">". $subject_f["menu_name"]."</a></li>";

		$pages = findPagesForSubject($subject_f["id"]);
		$output .= "<ul class=\"pages\">";
			while($pages_f = mysqli_fetch_assoc($pages)){
				$output .= "<li ";

			// check to find the selected page
			if($pages_f["id"] == $page_id ){
				$output .= "class=\"selected\" ";
			} 
			$output .= "><a href=\"manage_content.php?page=".urlencode($pages_f["id"])."\">". $pages_f["menu_name"]."</a></li>";
			}
		$output .= "</ul>";
	}

	$output .= "</ul>";
	return $output;
}


 ?>