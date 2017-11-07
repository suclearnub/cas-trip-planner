<?php
  function initPage($title, $styleSheetName) {
    echo("<!DOCTYPE html>\r\n
          <head>\r\n
          <html lang='en'>\r\n
    	    <title>$title</title>\r\n
    	    <meta charset='utf-8'>\r\n
    	    <meta name='viewport' content='width=device-width, initial-scale=1'>\r\n
     	    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>\r\n
          <link rel='stylesheet' href='$styleSheetName'>\r\n
     	    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>\r\n
     	    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>\r\n
          </head>\r\n
          <body>\r\n");

  }
  function drawNavBar($currentPage, $database) {
    # Draws the navbar
    echo("<nav class='navbar navbar-inverse navbar-static-top'>\r\n
	<div class='container-fluid'>\r\n
		<div class='navbar-header'>\r\n
			<a class='navbar-brand' href='#'>CAS Trip Planner</a>\r\n
		</div>\r\n
	<ul class='nav navbar-nav'>\r\n");
  $sql = "SELECT * FROM menuItems";
  $results = $database -> query($sql);

  if($results -> num_rows > 0) {
    while($row = $results -> fetch_assoc()) {
      if($row['text'] == $currentPage) {
        echo("<li class='active'><a href='$row[target]'>$row[text] </a></li>");
      }
      else {
        echo("<li><a href='$row[target]'>$row[text] </a></li>");
      }
    }
    echo("
    	</ul>
	</div>
</nav>");
  }
}

  function databaseConnect() {
    # Initiates a connection to the database
    $serverName = "mysql.cs.carmel.edu.hk";
    $username = "ansonelsa";
    $password = "AnsonAnson1299";
    $dbName = "anson_cs";

    $database = new mysqli($serverName, $username, $password, $dbName);
    return $database;
  }


  function startSession() {
    # Starts new session and inits variables
    session_start();
    if (!isset ($_SESSION['LoggedIn'])) {
      $_SESSION['LoggedIn'] = FALSE;
    }
    if (!isset ($_SESSION['attempts'])){
      $_SESSION['attempts'] = 0;
    }
  }

  function securePage() {
    # Checks if the user is logged in. If not they will be redirected to another page
    startSession();
    if ($_SESSION['LoggedIn'] == FALSE) {
      header('Location: index.php');
    }
  }

 ?>
