<?php 

	session_start();

	function message() {
		if (isset($_SESSION["message"])) {
	      $output = "<div class=\"alert alert-info\">";
	      $output .= htmlentities($_SESSION["message"]);
	      $output .= "</div>";

	      // Clear message
	      $_SESSION["message"] = null;

	      return $output;
      	} 
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
	      $errors = ($_SESSION["errors"]);

	      // Clear message
	      $_SESSION["errors"] = null;

	      return $errors;
      	} 
	}

?>