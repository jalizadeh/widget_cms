<?php 

function redirectTo($new_location){
	header("Location: ".$new_location);
	exit;
}


function confirmQuery($result){
	if(!$result){
		die("Database query failed.");
	}
}

// prepare the query for security
function mysqli_prep($string){
	global $connection;

	$escaped_string = mysqli_real_escape_string($connection,$string);
	return $escaped_string;
}

// find all subjects ~/visible inside subjects
function findAllSubjects(){
	global  $connection;

	$query = "SELECT * FROM subjects";
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


// will find only 1 result for the selected subject
// recives the $subject_id from $_GET
function findSelectedSubjectById($subject_id){
	global $connection;

	$safe_id = mysqli_real_escape_string($connection,$subject_id);
	$query = "SELECT * FROM subjects
				 WHERE id = {$safe_id}
				 LIMIT 1";
	$subject_set = mysqli_query($connection, $query);
	confirmQuery($subject_set);
	if ($subject = mysqli_fetch_assoc($subject_set)){
		return $subject;
	} else {
		return null;
	}
}


// will find only 1 result for the selected page
// recives the $page_id from $_GET
function findSelectedPageById($page_id){
	global $connection;

	$safe_id = mysqli_real_escape_string($connection,$page_id);
	$query = "SELECT * FROM pages
				 WHERE id = {$safe_id}
				 LIMIT 1";
	$page_set = mysqli_query($connection, $query);
	confirmQuery($page_set);
	if ($page = mysqli_fetch_assoc($page_set)){
		return $page;
	} else {
		return null;
	}
}

// by clicking on the navigation menu, it will select which item is clicked
// then will change the css + load the data
function findSelectedSubject_Page(){
	global $current_subject;
	global $current_page;

	if(isset($_GET["subject"])){
		$current_subject = findSelectedSubjectById($_GET["subject"]);
		$current_page = null;
	} elseif (isset($_GET["page"])){
		$current_subject = null;
		$current_page = findSelectedPageById($_GET["page"]);
	} else{
		$current_subject = null;
		$current_page = null;
	}
}


// it shows the navigation menu
// also puts bullet beside the selected subject/page
function navigation($subject_array, $page_array){
	$output = "<ul class=\"subjects\">";
	$subjects = findAllSubjects();
	while($subject_f = mysqli_fetch_assoc($subjects)){
		$output .= "<li ";
		// check to find the selected subject
		if($subject_f["id"] == $subject_array["id"] ){
			$output .= "class=\"selected\"";
		} 
		$output .= ">";
		$output .= "<a href=\"manage_content.php?subject=".urlencode($subject_f["id"])."\">". $subject_f["menu_name"]."</a></li>";

		$pages = findPagesForSubject($subject_f["id"]);
		$output .= "<ul class=\"pages\">";
			while($pages_f = mysqli_fetch_assoc($pages)){
				$output .= "<li ";

			// check to find the selected page
			if($pages_f["id"] == $page_array["id"] ){
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