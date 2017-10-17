<?php 
	function head($title, $stylesheetName){
	  echo("<!DOCTYPE html> \r\n");
	  echo("<html> \r\n");
	  echo("<head> \r\n");
	  echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"$stylesheetName\"> \r\n");
	  echo("<title> $title </title> \r\n");
	  echo("</head> \r\n");
	  echo("<body> \r\n");
    }

	function start_Session() {
		session_start();
		if (!isset ($_SESSION['LoggedIn'])) {
			$_SESSION['LoggedIn'] = FALSE; 
		}
		if (!isset ($_SESSION['attempts'])){
			$_SESSION['attempts'] = 0;
		}
	}
	
	function secure_Page() {
		start_session (); 
		if ($_SESSION['LoggedIn'] == FALSE) {
			header('Location: login.php');
		}
	}
	
	function check_Attempts() {
		if ($_SESSION['attempts'] == 3){
			session_destroy();
			header('Location: http://www.google.com');
		}
	}
	
?>
