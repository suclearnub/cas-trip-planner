<?php
	require_once('stdlib.php');
	start_Session();
	$_SESSION['LoggedIn'] = FALSE;
	$_SESSION['attempts'] = 0;
	header('Location: login.php');
?>
