<?php
	require_once('stdlib.php');
	startSession();
  $serverName = "mysql.cs.carmel.edu.hk";
  $username = "ansonelsa";
  $password = "AnsonAnson1299";
  $dbName = "anson_cs";

  $database = new mysqli($serverName, $username, $password, $dbName);
  if ($database -> connect_error) {
    die('Connection failed: ' . $database -> connect_error);
  }

  $sql = "SELECT email, password FROM users";
  $results = $database -> query($sql);

	if($results -> num_rows > 0) {
		while($row = $results -> fetch_assoc()) {
			if($_POST['email'] == $row['email'] && $_POST['password'] == $row['password']) {
				$_SESSION['LoggedIn'] == TRUE;
				header('Location: homepage.php');
			}
		}
	}
	/* if ($_POST['email'] = "emerald" && $_POST['pass'] == "admin"){
		$_SESSION['LoggedIn'] = TRUE;
		header('Location: main.php');

	} */
	else{
		header('Location: fail.php');
		$_SESSION['attempts']++;
	}
?>
