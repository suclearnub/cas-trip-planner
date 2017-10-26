<?php
  require_once("stdlib.php");
  startSession();
  initPage($title="Login", $styleSheetName="index.css")
 ?>
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

<form target="login.php" method="post" class="form-signin">
  <h1 class="form-signin-heading text-muted">Sign In</h1>
  <input type="text" class="form-control" placeholder="Email address" required="" autofocus="">
  <input type="password" class="form-control" placeholder="Password" required="">
  <button class="btn btn-lg btn-primary btn-block" type="submit">
    Sign In
  </button>
</form>
<form target="forgot.php" class="form-signin">
  <button class="btn btn-primary btn-block" type="submit">
    Sign Up
  </button>
  <button class="btn btn-warning btn-block" type="submit">
    Forgot Password?
  </button>
</form>

</div>
</html>
