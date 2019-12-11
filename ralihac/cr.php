<?php
require_once 'system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
?>
<div class='container'>
  <div class='row align-items-center'>
    <div class='col-md-7 offset-md-2'>
      <div class="d-flex justify-content-center h-100" style='margin-top: 5rem;'>
        <div class='row'>
            <div class='col-md-9 offset-md-3'>
              <h2><b>Create your New Account</b></h2>
          </div>
    <div class='col-md-7 offset-md-3'>
              <h5>Get your ideas out there</h5>
          </div>

            <div class='col-md-7 offset-md-3'>
            <br />

            <form method="post" action="cr.php" onsubmit="return user_validate()" name="vform">
              <!-- change vForm -->
              <div class="input-group form-group">
                  <input type="text" class="form-control" placeholder="Username" aria-describedby="user_error" name="username" value="">
                  <small id="user_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" value="">
                <small id="password_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" value="">
                <small id="confirmPassword_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" value="">
                <small id="email_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="form-group">
                <input type="submit" value="Sign Up" class="btn btn-light text-primary btn-block border-primary" name"signUp">
              </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<?php
include 'includes/footer.php';
?>
