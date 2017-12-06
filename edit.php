<?
require_once('stdlib.php');
securePage();
$database = databaseConnect();

$pk = $_POST['pk'];
$name = $_POST['name'];
$value = $_POST['value'];

if(!empty($value)) {
  $results = getQuery("UPDATE ")


} else {
  /*
  In case of incorrect value or error you should return HTTP status != 200.
  Response body will be shown as error message in editable form.
  */

  header('HTTP/1.0 400 Bad Request', true, 400);
  echo "This field is required!";
}

?>
