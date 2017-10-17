<?php
	require_once('stdlib.php');
	start_Session(); 
	
	if ($_POST['username'] = "admin" && $_POST['password'] == "admin"){
		$_SESSION['LoggedIn'] = TRUE;
		header('Location: dashboard/index.php');
		
	}
	else{
		header('Location: login.php');
		$_SESSION['attempts']++;
	}
?>
