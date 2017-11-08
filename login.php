<?php
	require_once('stdlib.php');
	startSession();
  $database = databaseConnect();
  if ($database -> connect_error) {
    die('Connection failed: ' . $database -> connect_error);
  }

  $sql = "SELECT email, password, firstName FROM users";
  $results = $database -> query($sql);

	if($results -> num_rows > 0) {
		while($row = $results -> fetch_assoc()) {
			if($_POST['email'] == $row['email'] && hash('sha256', $_POST['password']) == $row['password']) {
				$_SESSION['LoggedIn'] = TRUE;
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['firstName'] = $row['firstName'];
				header('Location: home.php');
			}
		}
	}
	else {
		$_SESSION['attempts']++;
		header('Location: index.php');
	}
?>
