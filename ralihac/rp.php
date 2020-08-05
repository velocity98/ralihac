<?php
require_once './system/initialize.php';
if (is_logged_in_user() == true){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
 ?>
 <div class="container">


       <div class="d-flex row justify-content-center align-items-center h-100" style='margin-top: 5rem;'>
           <div class='col-md-4 text-center '>




                  <img src='images/siteimages/RalihacLogo.png' style='height: 7rem; margin-bottom: 5%' />
                  <div class='connect'>
                  <div class='transition'>

                    <h5 style='margin-bottom: 4%'>Password Reset</h5>
                    <p>
                      You will receive a link in your email to reset your Password
                    </p>
                    <table id='tableHolder' style='width: 100%; margin-bottom: 4%'>
                      <tbody class='text-danger text-justify'>

                      </tbody>
                    </table>


                  <form method="post" action="" onsubmit="return forgotValidate()" name="zform" id='forgotForm' >
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Enter your Email" aria-describedby="email_error" name="email" value="">
                        <small id="email_error" class="form-text val_error text-danger w-100 text-left"></small>
                    </div>

                    <div class="form-group">
                      <input type="submit" value="Submit" class="btn btn-light text-primary btn-block border-primary" name"forgotSubmit">
                    </div>
                  </form>
                  </div>



              </div>



           </div>
     </div>


  </div>

<?php
include 'includes/footer.php';
 ?>

<script type='text/javascript' src='rp.js'></script>
