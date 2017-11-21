<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
initPage($title='My Trips', $styleSheetName='');
drawNavBar($currentPage='My Trips', $database);
if (checkPermission($database, 0) || checkPermission($database, 2) || checkPermission($database, 4)) {
  # If this is true, they have unlimited power, view others or edit others -> show them any trip!
  echo("<div class='container-fluid'>");
  drawTable("SELECT tripActivityNo, description, cost, confirmed, startDate, endDate FROM tripActivities WHERE tripNo = $_POST[id]", $database, ["Activity ID", "Description", "Cost", "Start Date", "End Date"], "activity", "tripActivityNo", "id");

}
else {
  # Else, they can only see their own trips. Therefore, check if they're actually in the trip. they're requesting
  if (!inTrip($database, $_POST['id'])) {
    header('Location: home.php');
  }
}
?>
</div>
</html>
