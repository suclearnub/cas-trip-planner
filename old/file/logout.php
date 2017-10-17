<?php
	require_once('stdlib.php');
	start_Session();
	$_SESSION['LoggedIn'] = FALSE;
	header('Location: index.php');
?>
