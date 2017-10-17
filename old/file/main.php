<?php
	require_once('stdlib.php');
	secure_Page();
	head("Main Page", "stdlibstylesheet.css");	
?>


		<h1>Main Page</h1>
		<p>Files</p>
		<?php
		if($handle = opendir('./files')) {
			while(false !== ($entry = readdir($handle))) {
				if($entry != "." && $entry != "..") {
					echo "<a href='/files/$entry'>$entry</a>";
					echo "<br>";
				}
			}
			closedir($handle);
		}
		?>

		<a href= "logout.php">Logout</a>
	</body>
</html>
	
