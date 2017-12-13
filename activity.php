<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
initPage($title='Activities', $styleSheetName='');
drawNavBar($currentPage='Activities', $database);
$parentActivity = getActivitiesParent($database, $_GET['id']);
if(checkPermission($database, [0, 2, 4] ,$_SESSION['userNo']) || inTrip($database, $parentActivity, $_SESSION['userNo'])) {
  echo("<div class='container-fluid'>");
  $tripName = getTripName($parentActivity, $database);
  echo("<h1>Activity for $tripName</h1>");
  echo("<h2>Overview:</h2>");
  if (checkPermission($database, [0, 2, 4], $_SESSION['userNo'])) {
    drawTable("SELECT tripActivitiesNo, description, cost, CASE WHEN confirmed = 1 THEN 'Yes' WHEN confirmed = 2 THEN 'Rejected' ELSE 'No' END AS confirmed, startDate, endDate FROM tripActivities WHERE tripActivitiesNo = $_GET[id]", $database, ['ID', 'Description', 'Cost', 'Confirmation', 'Start Date', 'End Date'], 'activity', 'tripActivitesNo', 'id', ['noteditable', 'description', 'cost', 'confirmation', 'startDate', 'endDate'], TRUE, 'tripActivities');
  } else {
    drawTable("SELECT tripActivitiesNo, description, cost, CASE WHEN confirmed = 1 THEN 'Yes' WHEN confirmed = 2 THEN 'Rejected' ELSE 'No' END AS confirmed, startDate, endDate FROM tripActivities WHERE tripActivitiesNo = $_GET[id]", $database, ['ID', 'Description', 'Cost', 'Confirmation', 'Start Date', 'End Date'], 'activity', 'tripActivitesNo', 'id', ['noteditable', 'noteditable', 'noteditable', 'noteditable', 'noteditable', 'noteditable'], FALSE, 'noteditable');
  }
}
else {
  header('Location: home.php');
}
