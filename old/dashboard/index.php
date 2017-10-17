<?php
	require_once('../stdlib.php');
	secure_Page();
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

	<title>CASmate | Dashboard</title>
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
 		<li class="active"><a href="#">Dashboard <span class="glyphicon glyphicon-dashboard"></span></a></li>
		<li><a href="profile.php">Profile <span class="glyphicon glyphicon-user"></span></a></li>
		<li><a href="../logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
    	</ul>
	</div>
</nav>

<div class="container-fluid">
	<h1>Welcome back.</h1>
	<p>You've logged in.</p>
	<p>To get started, navigate using the bar above.</p>	
</div>

</body>
</html>
