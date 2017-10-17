<?php
	require_once('stdlib.php');
	start_Session(); 
	
	if ($_POST['uname'] = "emerald" && $_POST['pass'] == "admin"){
		$_SESSION['LoggedIn'] = TRUE;
		header('Location: main.php');
		
	}
	else{
		header('Location: index.php');
		$_SESSION['attempts']++;
	}
?>
