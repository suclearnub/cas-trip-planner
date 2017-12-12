<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();
insertComments($_POST['id'], $_POST['table'], $database, $_POST['message'], $_POST['returnURL']);
header('Location: ' . $_POST['returnURL']);
?>