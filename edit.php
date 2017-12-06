<?
require_once('stdlib.php');
securePage();
$database = databaseConnect();

$pk = $_POST['pk']; # Value of primary key
$name = $_POST['name']; # Name of column to update
$value = $_POST['value']; # Value to update

$table = $_GET['table']; # Table name
$pkName = $_GET['pkName']; # Name of primary key column
$id = $_GET['id']; # Value of id to check against if there can be multiple entries (for tables such as users)
$kName = $_GET['kName']; # Name of column to check against if there can be multiple entries

# alternateUpdate is set to TRUE if the table has multiple entries and therefore needs another check.
if($kName == NULL && $id == NULL) { $alternateUpdate = FALSE; }
else { $alternateUpdate = TRUE; }

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
