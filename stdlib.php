<?php
  function initPage($title, $styleSheetName) {
    echo("<!DOCTYPE html>\r\n
        <head>\r\n
        <html lang='en'>\r\n
        <title>$title</title>\r\n
        <meta charset='utf-8'>\r\n
        <meta name='viewport' content='width=device-width, initial-scale=1'>\r\n
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>\r\n
        <link rel='stylesheet' href='$styleSheetName'>\r\n
        <link rel='stylesheet' href='master.css'>\r\n
        <link rel='stylesheet' href='comments.css'>\r\n
        <link rel='stylesheet' href='datetime-picker/css/bootstrap-datetimepicker.min.css'>\r\n
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>\r\n
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>\r\n
        <link href='//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css' rel='stylesheet'/>\r\n
        <script src='//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js'></script>\r\n
        <script src ='//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js'></script>\r\n
        <script src='js/moment.min.js'></script>\r\n
        <script type='text/javascript' src='datetime-picker/js/bootstrap-datetimepicker.min.js'></script>
        <script src='edit.js'></script>\r\n
        <script src='modals.js'></script>
        </head>\r\n
        <body>\r\n");

  }
  function drawNavBar($currentPage, $database) {
    # Draws the navbar
    echo("<nav class='navbar navbar-inverse navbar-static-top'>\r\n
	<div class='container-fluid'>\r\n
		<div class='navbar-header'>\r\n
			<a class='navbar-brand' href='#'>CAS Trip Planner</a>\r\n
		</div>\r\n
	<ul class='nav navbar-nav'>\r\n");
  $sql = "SELECT * FROM menuItems";
  $results = $database -> query($sql);

  if($results -> num_rows > 0) {
    while($row = $results -> fetch_assoc()) {
      if($row['text'] == $currentPage) {
        echo("<li class='active'><a href='$row[target]'>$row[text] </a></li>");
      }
      else {
        echo("<li><a href='$row[target]'>$row[text] </a></li>");
      }
    }
    echo("
    	</ul>
	</div>
</nav>");
  }
}

  function ifEmptyRedir() {
    if($_GET['id'] == NULL ) {
      header('Location: home.php');
    }
  }

  function databaseConnect() {
    # Initiates a connection to the database
    $serverName = "mysql.cs.carmel.edu.hk";
    $username = "ansonelsa";
    $password = "AnsonAnson1299";
    $dbName = "anson_cs";

    $database = new mysqli($serverName, $username, $password, $dbName);
    return $database;
  }

  function checkPermission($database, $action, $userNo) {
    # This function can be used to check if a user has any one of the permissions in argument $action
    foreach($action as $a) {
      $permissions = getQuery("SELECT * FROM userPermissions WHERE userNo=$userNo", $database);
      while($row = $permissions -> fetch_assoc()) {
        if($row['permissionNo'] == $a) { return True; }
      }
    }
    return False;
  }

  function inTrip($database, $tripNo, $userNo) {
    $trips = getQuery("SELECT * from trips t join tripParticipants p on t.tripNo = p.tripNo WHERE p.userNo = $userNo", $database);
    while($row = $trips -> fetch_assoc()) {
      if($row['t.tripNo'] == $tripNo) {
        return True;
      }
    }
    return False;
  }


  function startSession() {
    # Starts new session and inits variables
    session_start();
    if (!isset ($_SESSION['LoggedIn'])) {
      $_SESSION['LoggedIn'] = FALSE;
    }
    if (!isset ($_SESSION['attempts'])){
      $_SESSION['attempts'] = 0;
    }
  }

  function getQuery($sql, $database) {
    return $database -> query($sql);
  }

  function securePage() {
    # Checks if the user is logged in. If not they will be redirected to another page
    startSession();
    if ($_SESSION['LoggedIn'] == FALSE) {
      header('Location: index.php');
    }
  }

  function getActivityDesc($activityNo, $database) {
    $results = getQuery("SELECT description FROM tripActivities WHERE tripActivitiesNo = $activityNo", $database);
    while($row = $results -> fetch_assoc()) {
      return $row['description'];
    }
    return NULL;
  }

  function getTripName($tripNo, $database) {
    $results = getQuery("SELECT tripName FROM trips WHERE tripNo = $tripNo",$database);
    while($row = $results -> fetch_assoc()) {
      return $row['tripName'];
    }
    return NULL;
  }

  function getConfirmation($no, $table, $database) {
    if($table == 'trips') {
      $noTable = 'tripNo';
    }
    if($table == 'tripActivities') {
      $noTable = 'tripActivities';
    }
    $results = getQuery("SELECT CASE WHEN confirmed = 1 THEN 'Yes' ELSE 'No' END AS confirmed FROM $table WHERE $noTable = $no", $database);
    while($row = $results -> fetch_assoc()) {
      return $row['confirmed'];
      }
    return NULL;
  }

  function getParticipants($tripNo, $database) {
    # Takes a trip number and returns an array of participants
    $participantsList = array();
    $results = getQuery("SELECT userNo FROM tripParticipants WHERE tripNo = $tripNo", $database);
    while($row = $results -> fetch_assoc()) {
      foreach($row as $rowElement) {
        $participantsList[] = $rowElement;
      }
    }
    return $participantsList;
  }

  function getActivitiesParent($database, $activityNo) {
    $parentTrip = getQuery("SELECT tripNo FROM tripActivities WHERE tripActivitiesNo = $activityNo", $database);
    while($row = $parentTrip -> fetch_assoc()) {
      return $row['tripNo'];
    }
    return NULL;
  }

  function drawNonSQLTable($data, $colNames){
    # Draws a nice table without all that tedious mucking about in SQL.
    echo("<table class='table table-striped table-bordered table-hover fixedWidth'>\r\n");
    echo("<thead>\r\n");
    echo("<tr>\r\n");
    foreach($colNames as $col) {
      echo("<th>$col</th>\r\n");
    }
    echo("</tr>");
    echo("</thead>\r\n");
    echo("<tbody data-link='row' class='rowlink'>\r\n");
    foreach($data as $dataElement) {
      echo("<tr>\r\n");
      if (sizeof($dataElement) > 1) {
        foreach ($dataElement as $dataSubElement) {
          echo("<td>$dataSubElement</td>\r\n");
        }
      } else {
        echo("<td>$dataElement</td>");
      }
      echo("</tr>\r\n");
    }
    echo("</tbody>\r\n");
    echo("</table>\r\n");
  }


  function drawTable($sql, $database, $colNames, $getTo, $getTargetName, $getVarName, $jsNames, $editable, $tableTarget) {
    $results = getQuery($sql, $database);
    $tableTarget = $tableTarget . "_";
    echo("<table class='table table-striped table-bordered table-hover fixedWidth'>\r\n");
    echo("<thead>\r\n");
    echo("<tr>\r\n");
    foreach($colNames as $col) {
      echo("<th class='col-lg-3'>$col</th>\r\n");
    }
    echo("</tr>");
    echo("</thead>\r\n");
    echo("<tbody data-link='row' class='rowlink'>\r\n");
    while($row = $results -> fetch_assoc()) {
      echo("<tr>\r\n");
      $i = 0;
      $columns = array_keys($row);
      foreach($row as $rowElement) {
        $combined = $tableTarget . $jsNames[$i];
        if ($i == 0) {
          $pKey = $rowElement;
          echo("<td><a href='$getTo.php?$getVarName=$row[$getTargetName]' class='lookNormal'>$rowElement</a></td>\r\n");
        } else {
          if ($editable == TRUE) { echo("<td class='rowlink-skip'><span id='$combined'><a data-pk='$pKey' data-name='$columns[$i]'>$rowElement</a></span></td>\r\n"); }
          else { echo("<td>$rowElement</td>\r\n"); }
        }
        $i++;
      }
      echo("</tr>\r\n");
    }
    echo("</tbody>\r\n");
    echo("</table>\r\n");
  }

  function drawComments($id, $table, $database) {
    # Source: https://bootsnipp.com/snippets/featured/user-comment-example
    if($table == 'trips') { $tableComments = 'tripComments'; $noComments = 'tripNo'; }
    if($table == 'activities') { $tableComments = 'tripActivityComments'; $noComments = 'tripActivityNo'; }
    $results = getQuery("SELECT t.userNo, CONCAT(firstName, ' ', lastName) AS name, postDate, message FROM $tableComments t JOIN users u WHERE t.userNo = u.userNo AND t.$noComments = $id ORDER BY t.postDate ASC", $database);
    while($row = $results -> fetch_assoc()) {
      echo("<div class=\"panel panel-default\">
            <div class=\"panel-heading\">
            <strong><a href='profile.php?id=$row[userNo]'>$row[name]</a></strong> <span class=\"text-muted\">commented on $row[postDate]:</span>
            </div>
            <div class=\"panel-body\">
            $row[message]
            </div>
            </div>");
    }
  }

  function drawCommentsBox($id, $table) {
    # Source: https://bootsnipp.com/snippets/featured/comment-box
    $currentURL = $_SERVER['REQUEST_URI'];
    echo("<div class='container'>
          <div class='row'>
            <div class='widget-area no-padding blank'>
            <div class='status-upload'>
              <form action='comment.php' method='post'>
                <input type='hidden' name='returnURL' value='$currentURL'>
                <input type='hidden' name='id' value='$id'>
                <input type='hidden' name='table' value='$table'>
                <textarea name='message' placeholder=\"Say something...\" ></textarea>
                <button type='submit' class='btn btn-success green'>Post</button>
              </form>
            </div>
            </div>
          </div>
          </div>");
  }

  function insertComments($id, $table, $database, $message, $returnURL) {
    if($table == 'trips') {
      getQuery("INSERT INTO tripComments (tripNo, userNo, postDate, message) VALUES ($id, $_SESSION[userNo], CURRENT_TIMESTAMP, '$message')", $database);
    }
    if($table == 'activities') {
      getQuery("INSERT INTO tripActivityComments (tripActivityNo, userNo, postDate, message) VALUES ($id, $_SESSION[userNo], CURRENT_TIMESTAMP, '$message')", $database);
    }
  }

  function getAllUsers($database) {
    getQuery("SELECT CONCAT(firstName, ' ', lastName) AS name, userNo FROM users", $database);
  }

  function drawModal($database, $type) {
    $name = ['trips' => 'New Trip', 'activities' => 'New Activity', 'addStudent' => 'Add a student', 'removeStudent' => 'Remove a student']; # Arrays act like dicts??
    $table = ['trips' => 'trips', 'activities' => 'tripActivities', 'addStudent' => 'tripParticipants', 'removeStudent' => 'tripParticipants'];
    $title = $name[$type] . '...';
    $currentURL = $_SERVER['REQUEST_URI'];
    # Here's the headers for getting a modal up
    $dataTarget = "#myModal" . $type;
    $dataTargetID = "myModal" . $type;
    echo("<button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='$dataTarget'>
         $name[$type]
         </button>
        <div class='modal fade' id='$dataTargetID' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
          <div class='modal-dialog' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <h4 class='modal-title' id='myModalLabel'>$title</h4>
              </div>
            <div class='modal-body'>
            <form action='update.php' method='post' class='form-signin'>
              <input type='hidden' name='returnURL' value='$currentURL'>
              <input type='hidden' name='table' value='$table[$type]'>");
    # and here's the juicy stuff
    if($type == 'trips') {
      echo("<input type='text' class='form-control' placeholder='Trip name' required='True' autofocus='' name='tripName'><br>
            <input type='text' class='form-control' placeholder='Description' required='True' autofocus='' name='description'><br>
            <div class='form-group'>
              <div class='input-group date' id='datetimepicker1'>
                <input type='text' class='form-control' placeholder='Start date' />
                <span class='input-group-addon'>
                  <span class='glyphicon glyphicon-calendar'></span>
                </span>
               </div>
             </div>
             
             <br>
             
             <div class='form-group'>
               <div class='input-group date' id='datetimepicker2'>
                <input type='text' class='form-control'  placeholder='End date'/>
                <span class='input-group-addon'>
                  <span class='glyphicon glyphicon-calendar'></span>
                </span>
               </div>
              </div>
              <input type='hidden' name='confirmed' value='False'>");
    }
    else if($type == 'activities') {
      echo("<input type='hidden' name='tripNo' value='$_GET[id]'>
            <input type='text' class='form-control' placeholder='Description' required='True' autofocus='' name='description'><br>
            <input type='number' class='form-control' placeholder='Cost per person' required='True' autofocus='' name='cost'><br>
            <div class='form-group'>
              <div class='input-group date' id='datetimepicker3'>
                <input type='text' class='form-control' placeholder='Start date' />
                <span class='input-group-addon'>
                  <span class='glyphicon glyphicon-calendar'></span>
                </span>
              </div>
            </div>
            <br>
            <div class='form-group'>
             <div class='input-group date' id='datetimepicker4'>
              <input type='text' class='form-control'  placeholder='End date'/>
              <span class='input-group-addon'>
                <span class='glyphicon glyphicon-calendar'></span>
              </span>
              </div>
             </div>
              <input type='hidden' name='confirmed' value='False'>");

    }
    else if($type == 'addStudent') {
      echo("<input type='hidden' name='tripNo' value='$_GET[id]'><br>
            <select class='form-control' name='userNo' placeholder='Select a user'><br>");
      $students = getQuery("SELECT CONCAT(firstName, ' ', lastName) AS name, userNo FROM users", $database);
      while ($row = $students->fetch_assoc()) {
        echo("<option value='$row[userNo]'>$row[name]</option>");
      }
      echo("</select>
            <input type='hidden' name='confirmed' value='False'><br>");
    }
    else if($type == 'removeStudent') {
      echo("<input type='hidden' name='tripNo' value='$_GET[id]'>
            <select class='form-control' name='userNo' placeholder='Select a user'><br>");
      $students = getQuery("SELECT CONCAT(firstName, ' ', lastName) AS name, userNo FROM users", $database);
      while ($row = $students->fetch_assoc()) {
        echo("<option value='$row[userNo]'>$row[name]</option>");
      }
      echo("</select>
            <input type='hidden' name='confirmed' value='False'>");
    }
    echo("
          <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            <button type='submit' class='btn btn-primary'>Save changes</button>
          </div>
          </div>
            </form>
          </div>
        </div>
      </div>
    </div>");
  }

 ?>
