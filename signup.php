<?php
require_once('stdlib.php');
$database = databaseConnect();
$pwhash = hash('sha256', $_POST['password']);
$results = getQuery("INSERT INTO users (firstName, lastName, gender, email, password, attempts, isTeacher, recoveryPhrase) VALUES ('$_POST[firstName]', '$_POST[lastName]', '$_POST[gender]', '$_POST[email]', $pwhash, 0, 0, '$_POST[phrase]')", $database);
echo("<a href='index.php'>Account creation success. Click here to return and log in...</a>");