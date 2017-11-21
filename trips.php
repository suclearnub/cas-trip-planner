<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
initPage($title='My Trips', $styleSheetName='');
drawNavBar($currentPage='My Trips', $database);
if (checkPermission($database, 0) || checkPermission($database, 2) || checkPermission($database, 4)) {
  # If this is true, they have unlimited power, view others or edit others -> show them any trip!
  echo("<p>Trip details here</p>");
}
else {
  # Else, they can only see their own trips. Therefore, check if they're actually in the trip.
  if (!inTrip($database, $_POST['id'])) {
    header('Location: home.php');
  }
}
?>