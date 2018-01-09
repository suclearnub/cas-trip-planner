<?php
  require_once("stdlib.php");
  startSession();
  initPage($title="Login", $styleSheetName="index.css")
 ?>
<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

<form action="login.php" method="post" class="form-signin">
  <h1 class="form-signin-heading text-muted">CAS Trip Planner</h1>
  <input type="text" class="form-control" placeholder="Email address" required="True" autofocus="" name="email">
  <input type="password" class="form-control" placeholder="Password" required="True" name="password">
  <button class="btn btn-lg btn-primary btn-block" type="submit">
    Sign in
  </button>
</form>

<form class="form-misc">
<button type='button' class="btn btn-primary btn-block" data-toggle='modal' data-target='#myModalSignUp'>
    Sign up
</button>
</form>

<div class='modal fade' id='myModalSignUp' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Sign up</h4>
            </div>
            <div class='modal-body'>
                <form action='signup.php' method='post' class='form-signup'>
                    <input type='text' class='form-control' placeholder='First name' required='True' autofocus='' name='firstName'><br>
                    <input type='text' class='form-control' placeholder='Last name' required='True' autofocus='' name='lastName'><br>
                    <input type='text' class='form-control' placeholder='Email address' required='True' autofocus='' name='email'><br>
                    <select class='form-control' placeholder='Gender' required='True' autofocus='' name='gender'>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                    <input type='password' class='form-control' placeholder='Password' required='True' autofocus='' name='password'><br>
                    <input type='text' class='form-control' placeholder='Recovery phrase' required='True' autofocus='' name='phrase'><br>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        <button type='submit' class='btn btn-primary'>Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form class="form-misc">
<button type='button' class="btn btn-warning btn-block" data-toggle='modal' data-target='#myModalForgotPassword'>
    Forgot password?
</button>
</form>

<div class='modal fade' id='myModalForgotPassword' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Recover password</h4>
            </div>
            <div class='modal-body'>
                <form action='reset.php' method='post' class='form-signup'>
                    <input type='text' class='form-control' placeholder='Email address' required='True' autofocus='' name='email'><br>
                    <input type='text' class='form-control' placeholder='Recovery phrase' required='True' autofocus='' name='phrase'><br>
                    <input type='password' class='form-control' placeholder='New password' required='True' autofocus='' name='cost'><br>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                        <button type='submit' class='btn btn-primary'>Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</html>
