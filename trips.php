<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
initPage($title='My Trips', $styleSheetName='');
drawNavBar($currentPage='My Trips', $database);
if (checkPermission($database, [0, 2, 4], $_SESSION['userNo']) || inTrip($database, $_GET['id'], $_SESSION['userNo'])) {
  # If this is true, they have unlimited power, view others or edit others -> show them any trip!
  echo("<div class='container-fluid'>");

  $tripName = getTripName($_GET['id'], $database);
  echo("<h1>$tripName</h1>");
  echo("<h2>Overview:</h2>");
  drawNonSQLTable([[sizeof(getParticipants($_GET['id'], $database)), 'Cost Placeholder', getConfirmation($_GET['id'], 'trips', $database)]], ['Participants', 'Cost', 'Confirmation']);

  echo("<br><br>");

  echo("<h2>Participants</h2>");
  if(checkPermission($database, [0, 7, 8], $_SESSION['userNo'])) {
      # If they have unlimited power, view student details or view other student details, show them the full thing
      drawTable("SELECT t.userNo, CONCAT(u.firstName, ' ', u.lastName) AS name, CASE WHEN confirmed = 1 THEN 'Yes' ELSE 'No' END AS confirmed, CASE WHEN passportOK = 1 THEN 'Yes' ELSE 'No' END AS passportOK, CASE WHEN visaOK = 1 THEN 'Yes' ELSE 'No' END AS visaOK, CASE WHEN paid = 1 THEN 'Yes' ELSE 'No' END AS paid FROM tripParticipants t JOIN users u ON t.userNo = u.userNo WHERE t.tripNo = 1
", $database, ['User ID', 'Name', 'Confirmed', 'Passport OK?', 'Visa OK?', 'Paid?'], 'profile', 'userNo', 'id');
  } else {
      # Just show them a list. Boring!
    drawTable("SELECT t.userNo, CONCAT(u.firstName, ' ', u.lastName) AS name FROM tripParticipants t JOIN users u ON t.userNo = u.userNo WHERE t.tripNo = 1
", $database, ['User ID', 'Name'], 'profile', 'userNo', 'id');
  }

  echo("<br><br>");

  echo("<h2>Activities</h2>");
  echo("<h4>Confirmed</h4>");
  drawTable("SELECT tripActivityNo, description, cost, CASE WHEN confirmed = 1 THEN 'Yes' ELSE 'No' END AS confirmed, startDate, endDate FROM tripActivities WHERE tripNo = $_GET[id] AND confirmed = True", $database, ["Activity ID", "Description", "Cost", "Confirmation", "Start Date", "End Date"], "activity", "tripActivityNo", "id");
  echo("<h4>Pending</h4>");
  drawTable("SELECT tripActivityNo, description, cost, CASE WHEN confirmed = 1 THEN 'Yes' ELSE 'No' END AS confirmed, startDate, endDate FROM tripActivities WHERE tripNo = $_GET[id] AND confirmed = False", $database, ["Activity ID", "Description", "Cost", "Confirmation", "Start Date", "End Date"], "activity", "tripActivityNo", "id");

}
else {
  # Else, they're either don't have the power to see everything or they're not in the trip
  header('Location: home.php');
}
?>
</div>
</html>
