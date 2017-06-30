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
function  findPagesForSubject($subjectId){
	global $connection;

	$query = " SELECT * FROM pages
				 WHERE subject_id = {$subjectId}
				 AND visible = 1
				 ORDER BY position ASC";
	$pages_q = mysqli_query($connection, $query);
	confirmQuery($pages_q);
	return $pages_q;
}


// it shows the navigation menu
// also puts bullet beside the selected subject/page
function navigation($subjectId, $pageId){
	$output = "<ul class=\"subjects\">";
	$subjects = findAllSubjects();
	while($subject_f = mysqli_fetch_assoc($subjects)){
		$output .= "<li ";
		// check to find the selected subject
		if($subject_f["id"] == $subjectId ){
			$output .= "class=\"selected\"";
		} 
		$output .= ">";
		$output .= "<a href=\"manage_content.php?subject=".urlencode($subject_f["id"])."\">". $subject_f["menu_name"]."</a></li>";

		$pages = findPagesForSubject($subject_f["id"]);
		$output .= "<ul class=\"pages\">";
			while($pages_f = mysqli_fetch_assoc($pages)){
				$output .= "<li ";

			// check to find the selected page
			if($pages_f["id"] == $pageId ){
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