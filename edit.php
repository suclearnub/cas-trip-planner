<?
require_once('stdlib.php');
securePage();
$database = databaseConnect();

$pk = $_POST['pk'];
$name = $_POST['name'];
$value = $_POST['value'];

$table = $_GET['table'];
$pkName = $_GET['pkName'];
$id = $_GET['id'];
$kName = $_GET['kName'];

if($kName == NULL && $id == NULL) { $alternateUpdate = TRUE; }
else { $alternateUpdate = FALSE; }

if(!empty($value)) {
  if ($alternateUpdate) {
    $results = getQuery("UPDATE $table SET ($name = $value) WHERE $pkName = $pk AND $kName = $id", $database);
  }
  else {
    $results = getQuery("UPDATE $table SET $name = $value WHERE $pkName = $pk", $database);
  }

} else {
  /*
  In case of incorrect value or error you should return HTTP status != 200.
  Response body will be shown as error message in editable form.
  */

  header('HTTP/1.0 400 Bad Request', true, 400);
  echo "This field is required!";
}

?>
