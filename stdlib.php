<?php
  function initPage() {
    # This function is used to initialize any page

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
      header('Location: home.php');
    }
  }

 ?>
