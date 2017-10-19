<?php
  require_once("stdlib.php");
  startSession();
  initPage($title="Login")
 ?>

<form action="login.php" method="POST">
   <div class="form-group">
     <label for="username">Username</label>
     <input class="form-control" name="username">
   </div>
   <div class="form-group">
     <label for="password">Password:</label>
     <input type="password" class="form-control" name="password">
   </div>
   <p><a href="reset.php">Forgot your password?</a></p>
   <p><a href="register.php">
   <button type="submit" class="btn btn-primary">Login</button>
</form>
</body>
</html>
  
