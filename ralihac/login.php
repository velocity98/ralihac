<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ralihac/system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
 ?>
 <div class="container">
 <div class="row align-items-center">
   <div class="col-md-8 offset-md-2">
       <div class="d-flex justify-content-center h-100">
           <div class="card card-style bg-info">
             <div class="card-header">
               <h4 class="text-light text-center" style='margin: 1px;'>Authentication</h4>
             </div>

             <div class="card-body">
               <table id='tableHolder' style='width:100%'>
                 <tbody class='text-danger text-justify'>

                 </tbody>
               </table>
               <form method="post" action="login.php" onsubmit="return user_validate()" name="xform" id='userLoginForm'>
                 <div class="input-group form-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text bg-primary"><i class="fas fa-user" style="color:white"></i></span>
                   </div>
                     <input type="text" class="form-control" placeholder="Username" aria-describedby="user_error" name="username" value="">
                     <small id="user_error" class="form-text val_error text-danger w-100"></small>
                 </div>

                 <div class="input-group form-group">
                   <div class="input-group-prepend">
                     <span class="input-group-text bg-primary"><i class="fas fa-key" style="color:white"></i></span>
                   </div>
                   <input type="password" class="form-control" placeholder="Password" name="password" value="">
                   <small id="password_error" class="form-text val_error text-danger w-100"></small>
                 </div>

                 <div class="form-group">
                   <input type="submit" value="Login" class="btn btn-light text-primary btn-block border-primary" name"loginuser">
                 </div>
               </form>
               <a href='cr.php' class='text-light'>Create new account</a>
               <br />
               <a href='#' class='text-light'>Forgot password</a>
             </div>
           </div>
         </div>
   </div>
  </div>
  </div>

<?php
include 'includes/footer.php';
 ?>
<script type='text/javascript' src='userLogin.js'></script>
