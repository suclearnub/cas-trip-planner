<?php
require_once('stdlib.php');
securePage();
$database = databaseConnect();

if($_POST['table'] == 'trips') {
  getQuery("INSERT INTO trips (tripName, description, startDate, endDate, confirmed) VALUES ('$_POST[tripName]', '$_POST[description]', '$_POST[startDate]', '$_POST[endDate]', 0", $database);
  header('Location: ' . $_POST['returnURL']);
}
else if($_POST['table'] == 'tripActivities') {
  getQuery("INSERT INTO tripActivities (tripNo, description, cost, startDate, endDate, confirmed) VALUES ('$_POST[tripNo]', '$_POST[description]', '$_POST[cost]', '$_POST[startDate]', '$_POST[endDate]', 0)", $database);
  header('Location: ' . $_POST['returnURL']);
}
else if($_POST['table'] == 'addStudent') {
  getQuery("INSERT INTO tripParticipants (userNo, tripNo, confirmed, passportOK, visaOK, paid) VALUES ('$_POST[userNo]', '$_POST[tripNo]', 0, 0, 0, 0)", $database);
  header('Location: ' . $_POST['returnURL']);
}
else if($_POST['table'] == 'removeStudent') {
  getQuery("DELETE FROM tripParticipants WHERE tripNo = '$_POST[tripNo]' AND userNo = '$_POST[userNo]'", $database);
  header('Location: ' . $_POST['returnURL']);
}
?>