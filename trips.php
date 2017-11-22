<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
initPage($title='My Trips', $styleSheetName='');
drawNavBar($currentPage='My Trips', $database);
if (checkPermission($database, 0) || checkPermission($database, 2) || checkPermission($database, 4)) {
  # If this is true, they have unlimited power, view others or edit others -> show them any trip!
  echo("<div class='container-fluid'>");
  echo("<h2>Activities</h2>");
  echo("<h4>Confirmed Activities</h4>");
  drawTable("SELECT tripActivityNo, description, cost, CASE WHEN confirmed = True THEN 'Yes' ELSE 'No' END AS confirmed, startDate, endDate FROM tripActivities WHERE tripNo = $_GET[id] AND confirmed = True", $database, ["Activity ID", "Description", "Cost", "Confirmation", "Start Date", "End Date"], "activity", "tripActivityNo", "id");
  echo("<br>");
  echo("<h4>Activities Pending Approval</h4>");
  drawTable("SELECT tripActivityNo, description, cost, CASE WHEN confirmed = True THEN 'Yes' ELSE 'No' END AS confirmed, startDate, endDate FROM tripActivities WHERE tripNo = $_GET[id] AND confirmed = False", $database, ["Activity ID", "Description", "Cost", "Confirmation", "Start Date", "End Date"], "activity", "tripActivityNo", "id");

}
else {
  # Else, they can only see their own trips. Therefore, check if they're actually in the trip. they're requesting
  if (!inTrip($database, $_GET['id'])) {
    header('Location: home.php');
  }
}
?>
</div>
</html>
