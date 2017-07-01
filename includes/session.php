<?php
	session_start();

	// it will show the messages kept inside session
	function sessionMessage(){
		if(isset($_SESSION["message"])){
			$output = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";

			return $output;
		}
	}

	// once the message is shown, it is used to clear session message
	function clearSM(){
		if(isset($_SESSION["message"])){
			$_SESSION["message"] = null;
		}
	}
	
?>