<?php
require_once('stdlib.php');
$database = databaseConnect();
$pwhash = hash('sha256', $_POST['password']);
$results = getQuery("UPDATE users SET password = '$pwhash' WHERE email = '$_POST[email]' AND recoveryPhrase = '$_POST[phrase]'", $database);
echo("<a href='index.php'>Password reset request has been submitted. Your password has been updated. Click here to continue...</a>");