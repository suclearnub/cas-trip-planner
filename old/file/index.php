<?php
	require_once('stdlib.php');
	start_Session();	
	check_Attempts();
	if ($_SESSION['LoggedIn'] == TRUE){
		header('Location: main.php');
	}	
	head("Login", "stdlibstylesheet.css");
?>


	<h1> Login Page</h1>
	<p>Please Login:</p>
		<form action = "login.php" method = "post">
			<p>Username: <input type = "text" name = "uname"><br>
			    Password: <input type = "password" name = "pass"></p>
			<input type = "submit" value = "Submit">
		</form>
	</body>
</html>