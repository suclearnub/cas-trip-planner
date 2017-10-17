<?php
	require_once('stdlib.php');
	start_Session();
	if ($_SESSION['LoggedIn'] == TRUE){
		header('Location: /dashboard/dash.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#64c891">
	<meta name="theme-color" content="#ffffff">

	<title>CASmate | Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">CASmate</a>
		</div>
	<ul class="nav navbar-nav">
 		<li><a href="index.html">Home <span class="glyphicon glyphicon-home"></span></a></li>
		<li><a href="about.html">About <span class="glyphicon glyphicon-info-sign"></span></a></li>
		<li class="active"><a href="#">Login <span class="glyphicon glyphicon-log-in"></span></a></li>
    	</ul>
	</div>
</nav>

<div class="container-fluid">
	<h1>Login to CASmate</h1>
	<p>Login here to access your CAS trip planning information, or <a href="register.php">sign up for a new account</a>.</p>
	<?php
	if($_SESSION['attempts'] != 0){
		echo('<div class="alert alert-danger">');
		
		if($_SESSION['attempts'] >= 5) {
			echo('<span class="glyphicon glyphicon-warning-sign"></span><strong> Error:</strong> Too many incorrect login attempts. Your account has been locked for security - please reset your password.');
		# Do something with databases, blergh
		}

		else {
			echo('<span class="glyphicon glyphicon-warning-sign"></span><strong> Error:</strong> Your username/password was incorrect.');
		}
		echo('</div>');
	}
?>	
	<form action="checkin.php" method="POST">
		<div class="form-group">
			<label for="username">Username</label>
			<input class="form-control" name="username">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" name="password">
		</div>
		<p><a href="reset.php">Forgot your password?</a></p>
		<button type="submit" class="btn btn-primary">Login</button>
	</form>
</div>
</body>
</html>
