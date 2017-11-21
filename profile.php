<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
initPage($title='My Profile', $styleSheetName='');
drawNavBar($currentPage='My Profile', $database);

?>
</div>
</html>
