<?php
	require_once('stdlib.php');
	securePage();
	$database = databaseConnect();
	initPage($title='Homepage', $styleSheetName='');
	drawNavBar($currentPage='Home', $database=$database);
?>
<div class="container-fluid">
<p>If you see this you are logged in</p>
<?php
	$results = $database -> query("SELECT firstName FROM users WHERE email=$_SESSION[email]");
	echo("<h2>Welcome back, $results</h2>")
?>
</div>
</body>
</html>
