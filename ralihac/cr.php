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
            <?php
            $username = ((isset($_POST['username']))?sanitize($_POST['username']):'');
            $username = trim($username);
            $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
            $password = trim($password);
            $confirmPassword = ((isset($_POST['confirmPassword']))?sanitize($_POST['confirmPassword']):'');
            $confirmPassword = trim($confirmPassword);
            $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
            $email = trim($email);
            $hash = password_hash($confirmPassword, PASSWORD_DEFAULT);
            $userCreate = date("Y-m-d H:i:s");
            $userHacks = '[]';
            $errorArray = [];
            if (isset($_POST)){
                $confirmQuery = ("SELECT * FROM user_db");
                $resultUsers = $db->query($confirmQuery);
                while($row = mysqli_fetch_assoc($resultUsers)){
                  if ($username == $row['user_username']){
                    array_push($errorArray, 'Error Username');
                  }
                  if ($email == $row['user_email']){
                    array_push($errorArray, 'Error Email');
                  }
                }
                if(count($errorArray) > 0){
                  var_dump($errorArray);
                }
                else{
                  $query = ("INSERT INTO user_db (user_username, user_password, user_email, user_create, user_lastlogin, user_hacks) VALUES (?,?,?,?,?,?)");
                  $stmt = $db->prepare($query);
                  $stmt->bind_param('ssssss', $username, $hash, $email, $userCreate, $userCreate, $userHacks);
                  $stmt->execute();
                  $stmt->close();
                }
            }
             ?>
            <form method="post" action="cr.php" onsubmit="return user_validate()" name="cform">

              <div class="input-group form-group">
                  <input type="text" class="form-control" placeholder="Username" aria-describedby="user_error" name="username" value="<?php echo $username?>">
                  <small id="user_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password?>">
                <small id="password_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" value="<?php echo $confirmPassword?>">
                <small id="confirmPassword_error" class="form-text val_error text-danger w-100"></small>
              </div>

              <div class="input-group form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email?>">
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
    </div>
  </div>
</div>
<?php
include 'includes/footer.php';
?>
<script type='text/javascript' src='cr.js'></script>
