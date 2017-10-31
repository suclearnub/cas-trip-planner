<?php
	require_once('stdlib.php');
	start_Session();
  $serverName = "mysql.cs.carmel.edu.hk";
  $username = "anson_cs";
  $password = "AnsonAnson1299";
  $dbName = "anson_cs";

  $database = new mysqli($serverName, $username, $password, $dbName);
  if ($database -> connect_error) {
    die('Connection failed: ' . $database -> connect_error);
  }

  $sql = "SELECT email, password FROM users";

	if ($_POST['uname'] = "emerald" && $_POST['pass'] == "admin"){
		$_SESSION['LoggedIn'] = TRUE;
		header('Location: main.php');

	}
	else{
		header('Location: index.php');
		$_SESSION['attempts']++;
	}
?>
