<?php
	require_once('stdlib.php');
	securePage();
	$database = databaseConnect();
	initPage($title='Homepage', $styleSheetName='');
	drawNavBar($currentPage='Home', $database);
?>
<div class="container-fluid">
<?php
	echo("<h2>Welcome back, $_SESSION[firstName].</h2>");
?>
<h3>Here's what's going on:</h3>
<h4>Your Trips</h4>
<?php
	$results = getQuery("SELECT * FROM userPermissions WHERE userNo=$_SESSION[userNo]", $database);
	while($row = $results -> fetch_assoc()) {
		if($row['userPermissions'] == 0 || $row['permissionNo'] == 2) {
			# If they have unlimited power or permission no. 2 (view_other_trips), list all the trips
			drawTable("SELECT * FROM trips", $database, ["Trip ID", "Name", "Description", "Start Date", "End Date", "Approval"], "trips", "tripNo", "id");
			}
		else {
			# Else, show all trips they are in.
			drawTable("SELECT * from trips t join tripParticipants p on t.tripNo = p.tripNo WHERE p.userNo = 1", $database,  ["Trip ID", "Name", "Description", "Start Date", "End Date", "Approval"], "trips", "tripNo", "id");
		}
		}
 ?>
<h4>Awaiting Approval</h4>
	<?php
		$results = getQuery("SELECT * FROM userPermissions WHERE userNo=$_SESSION[userNo]", $database);
		while($row = $results -> fetch_assoc()) {
			if($row['userPermissions'] == 0 || $row['permissionNo'] == 4) {
				# If they have unlimited power or permission no. 4 (modify_other_trips), list all the trips that haven't been confirmed
				drawTable("SELECT * FROM trips WHERE confirmed = 0", $database, ["Trip ID", "Name", "Description", "Start Date", "End Date", "Approval"], "trips", "tripNo", "id");
			}
			if ($row['userPermissions'] == 3) {
				# Else, check if they have permission to modify_own_trips
				# If they do, the have permission to edit all trips they are in
				drawTable("SELECT * from trips t join tripParticipants p on t.tripNo = p.tripNo WHERE p.userNo = 1", $database,  ["Trip ID", "Name", "Description", "Start Date", "End Date", "Approval"], "trips", "tripNo", "id");
			}
			else {
				# They are powerless to modify Trips
				echo("<br>");
			}
		}
	 ?>
<h4>New Comments</h4>
	<p>To be implemented.</p>
</div>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jasny-bootstrap.min.js"></script>
</body>
</html>
