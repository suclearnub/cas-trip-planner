<?php
  require_once("stdlib.php");
  startSession();
  initPage($title="Login", $styleSheetName="index.css")
 ?>
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

<form action="login.php" method="post" class="form-signin">
  <h1 class="form-signin-heading text-muted">Sign In</h1>
  <input type="text" class="form-control" placeholder="Email address" required="" autofocus="">
  <input type="password" class="form-control" placeholder="Password" required="">
  <button class="btn btn-lg btn-primary btn-block" type="submit">
    Welcome to the Planner
  </button>
</form>
<form action="signup.php" class="form-misc">
  <button class="btn btn-primary btn-block" type="submit">
    Sign Up
  </button>
</form>
<form action="forgot.php" class="form-misc">
  <button class="btn btn-warning btn-block" type="submit">
    Forgot Password?
  </button>
</form>

</div>
</html>
