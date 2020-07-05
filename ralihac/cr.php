<?php
require_once 'system/initialize.php';
if (is_logged_in_user() == true){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
?>
<div class='container'>
      <div class="d-flex row justify-content-center h-100" style='margin-top: 5rem;'>
          <div class='col-md-4'>
              <h2><b>Create your New Account</b></h2>

              <h5>Get your ideas out there</h5>

            <table id='tableHolder' style='width:100%'>
              <tbody class='text-danger text-justify'>

              </tbody>
            </table>
            <form method="post" action="" onsubmit="return user_validate()" id="submitForm" name="cform" style='margin-top: 5%'>

              <div class="input-group form-group">
                  <input type="text" class="form-control" placeholder="Username" aria-describedby="user_error" id="username" name="username"  />
                  <small id="user_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <small id="password_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="password" class="form-control" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword">
                <small id="confirmPassword_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                <small id="email_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="form-group">
                <input type="submit" id="signUp" value="Sign Up" class="btn btn-light text-primary btn-block border-primary" name="signUp" />
              </div>

            </form>

            <a href='login.php' class='text-primary'>Already have an Account? (Log in)</a>

          </div>
      </div>


</div>
<?php
include 'includes/footer.php';
?>
<script type='text/javascript' src='cr.js'></script>
