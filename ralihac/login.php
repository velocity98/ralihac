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
               <img src='images/siteimages/RalihacLogo.png' style='height: 7rem; margin-bottom: 5%'>
               <h5 style='margin-bottom: 10%'>Ralihac Authentication</h5>
               <table id='tableHolder' style='width: 100%; margin-bottom: 4%'>
                 <tbody class='text-danger text-justify'>

                 </tbody>
               </table>
             <form method="post" action="login.php" onsubmit="return user_validate()" name="xform" id='userLoginForm' >
               <div class="input-group form-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text bg-primary"><i class="fas fa-user" style="color:white"></i></span>
                 </div>
                   <input type="text" class="form-control" placeholder="Username or Email" aria-describedby="user_error" name="username" value="">
                   <small id="user_error" class="form-text val_error text-danger w-100 text-left"></small>

               </div>

               <div class="input-group form-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text bg-primary"><i class="fas fa-key" style="color:white"></i></span>
                 </div>
                 <input type="password" class="form-control" placeholder="Password" name="password" value="">
                 <small id="password_error" class="form-text val_error text-danger w-100 text-left"></small>
               </div>

               <div class="form-group">
                 <input type="submit" value="Login" class="btn btn-light text-primary btn-block border-primary" name"loginuser">
               </div>
             </form>
             <div  class='text-left'>
                <a href='cr.php'>Create new account</a>
             </div>
             <div class='text-left'>
                    <a href='rp.php'>Forgot password</a>
             </div>
           </div>
     </div>
  </div>

<?php
include 'includes/footer.php';
 ?>
<script type='text/javascript' src='userLogin.js'></script>
