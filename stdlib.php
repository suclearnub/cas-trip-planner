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
  function drawNavBar() {
    # Draws the navbar
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
