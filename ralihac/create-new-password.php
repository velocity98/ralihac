<?php
require_once './system/initialize.php';
if (is_logged_in_user() == true){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
include 'includes/loadingModal.php';
 ?>
 <div class="container">
       <div class="d-flex row justify-content-center h-100" style='margin-top: 5rem;'>
           <div class='col-md-4 text-center'>


             <?php

              if (isset($_GET['selector']) && isset($_GET['validator'])){

                $selector = $_GET['selector'];
                $validator = $_GET['validator'];

                if (empty($selector) || empty($validator)) {

                  echo "<div class='alert alert-danger text-left' role='alert'>
                   <h4 class='alert-heading'><span class='fas fa-exclamation-circle'></span> Uh Oh!</h4>
                    <h6>
                    Could not validate your request
                    </h6>
                    <h6><a href='rp.php' class='alert-link'>Click Here</a> if you want to reset your password</h6>
                    </div>";

                } else{

                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false): // view html form if statement doesnt return false
                      ?>
                      <img src='images/siteimages/RalihacLogo.png' style='height: 7rem; margin-bottom: 5%'>
                      <div class='connect'>
                      <div class='transition'>
                      <h5 style='margin-bottom: 4%'>Create New Password</h5>

                      <table id='tableHolder' style='width: 100%; margin-bottom: 4%'>
                        <tbody class='text-danger text-justify'>
                        </tbody>
                      </table>


                    <form method="post" action="" onsubmit="return resetValidate()" name="zform" id='resetForm' >
                      <input type='hidden' name='selector' value='<?php echo $selector?>' />
                      <input type='hidden' name='validator' value='<?php echo $validator?>' />
                      <div class="input-group form-group">
                          <input type="password" class="form-control" placeholder="New Password" aria-describedby="password_error" name="password" value="">
                          <small id="password_error" class="form-text val_error text-danger w-100 text-left"></small>
                      </div>
                      <div class="input-group form-group">
                          <input type="password" class="form-control" placeholder="Confirm New Password" aria-describedby="confirm_password_error" name="confirmPassword" value="">
                          <small id="confirm_password_error" class="form-text val_error text-danger w-100 text-left"></small>
                      </div>

                      <div class="form-group">
                        <input type="submit" value="Reset Password" class="btn btn-light text-primary btn-block border-primary" name"resetSubmit">
                      </div>
                    </form>

                  </div>
                </div>

                    <?php
                    endif;
                }

              } else{

                echo "<div class='alert alert-danger text-left' role='alert'>
                 <h4 class='alert-heading'><span class='fas fa-exclamation-circle'></span> Uh Oh!</h4>
                  <h6>
                  Could not validate your request
                  </h6>
                  <h6><a href='rp.php' class='alert-link'>Click Here</a> if you want to reset your password</h6>
                  </div>";

              }




             ?>


           </div>
     </div>
  </div>

<?php
include 'includes/footer.php';
 ?>

<script type='text/javascript' src='newPassword.js'></script>
