<?php
  require_once("stdlib.php");
  startSession();
  initPage($title="Login", $styleSheetName="index.css")
 ?>
<div id="fullscreen_bg" class="fullscreen_bg">

<form action="login.php" method="POST" class="form-signin">
  <h1>
    <h1 class="form-signin-heading text-muted">Sign In</h1>
		<input type="text" class="form-control" placeholder="Email" required="" autofocus="">
		<input type="password" class="form-control" placeholder="Password" required="">
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Sign In
		</button>
    <a href="forgot.php" class="btn btn-lg btn-primay btn-block">Go to Google</a>
</form>
</div>
</body>
</html>
