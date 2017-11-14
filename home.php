<?php
	require_once('stdlib.php');
	securePage();
	$database = databaseConnect();
	initPage($title='Homepage', $styleSheetName='');
	drawNavBar($currentPage='Home', $database);
?>
<div class="container-fluid">
<p>If you see this you are logged in</p>
<?php
	echo("<h2>Welcome back, $_SESSION[firstName].</h2>");
?>
<h3>Here's what's going on:</h3>
<h4>Your Trips</h4>
<?php
	$results = getQuery("SELECT * FROM userPermissions WHERE userNo=$_SESSION[userNo]", $database);
	echo($_SESSION['userNo']);
	while($row = $results -> fetch_assoc()) {
		if($row['userPermissions'] == 0 || $row['permissionNo'] == 2) {
			# If they have unlimited power or permission no. 2, list all the trips
			drawTable("SELECT * FROM trips", $database, ["Trip ID", "Name", "Description", "Start Date", "End Date", "Approval"]);
			}
		}
 ?>
<h4>Awaiting Approval</h4>
<h4>New Comments</h4>
</div>
</body>
</html>
