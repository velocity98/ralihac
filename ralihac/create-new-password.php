<?php
require_once './system/initialize.php';
if (is_logged_in_user() == true){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
 ?>
 <div class="container">
       <div class="d-flex row justify-content-center h-100" style='margin-top: 5rem;'>
           <div class='col-md-4 text-center'>


             <?php

              if (isset($_GET['selector']) && isset($_GET['validator'])){

                $selector = $_GET['selector'];
                $validator = $_GET['validator'];

                if (empty($selector) || empty($validator)) {

                  echo 'Could not validate your request';

                } else{

                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false): // view html form if statement doesnt return false
                      ?>
                      <img src='images/siteimages/RalihacLogo.png' style='height: 20%; margin-bottom: 5%'>
                      <h5 style='margin-bottom: 4%'>Create New Password</h5>

                      <table id='tableHolder' style='width: 100%; margin-bottom: 4%'>
                        <tbody class='text-danger text-justify'>
                        </tbody>
                      </table>


                    <form method="post" action="" onsubmit="return resetValidate()" name="zform" id='resetForm' >
                      <input type='hidden' name='selector' value='<?php echo $selector?>' />
                      <input type='hidden' name='validator' value='<?php echo $validator?>' />
                      <div class="input-group form-group">
                          <input type="password" class="form-control" placeholder="Enter your New Password" aria-describedby="password_error" name="password" value="">
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

                    <?php
                    endif;
                }

              } else{

                echo 'Could not validate your request';

              }




             ?>


           </div>
     </div>
  </div>

<?php
include 'includes/footer.php';
 ?>

<script type='text/javascript' src='newPassword.js'></script>
