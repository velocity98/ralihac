<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/ralihac/system/initialize.php';
  if(is_logged_in()){
    header('Location: index.php');
  }
  include './includes/head.php';
 ?>

    <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8 offset-md-2">
          <div class="d-flex justify-content-center h-100">
          		<div class="card card-style">
          			<div class="card-header">
          				<h3 class="text-light text-center">Administration</h3>
          			</div>
                <?php
                $user = ((isset($_POST['username']))?sanitize($_POST['username']):'');
                $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
                $temp = array();
                $temp = "Username or Password is Incorrect";
                if (isset($_POST)){
                    $userquery = ("SELECT * FROM admin WHERE admin_username = ? ");
                    $stmt = $db->prepare($userquery);
                    $stmt->bind_param('s', $user);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    if(!password_verify($password, $row['admin_password'])){
                      $user = null;
                      $password = null;
                    }
                    else{
                      $admin_id = $row['admin_id'];
                      login($admin_id);
                      $stmt->close();
                    }
                  }
                 ?>
          			<div class="card-body">
          				<form method="post" action="login.php" onsubmit="return user_validate()" name="vform">
          					<div class="input-group form-group">
          						<div class="input-group-prepend">
          							<span class="input-group-text bg-primary"><i class="fas fa-user" style="color:white"></i></span>
          						</div>
            						<input type="text" class="form-control" placeholder="Username" aria-describedby="user_error" name="username" value="<?php echo $user?>">
                        <small id="user_error" class="form-text val_error text-danger w-100"></small>
          					</div>

          					<div class="input-group form-group">
          						<div class="input-group-prepend">
          							<span class="input-group-text bg-primary"><i class="fas fa-key" style="color:white"></i></span>
          						</div>
          						<input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password?>">
                      <small id="password_error" class="form-text val_error text-danger w-100"></small>
          					</div>

          					<div class="form-group">
          						<input type="submit" value="Login" class="btn btn-info btn-block" name"login">
          					</div>
          				</form>
          			</div>
          		</div>
          	</div>
      </div>
     </div>
     </div>

<?php
include './includes/footer.php'
 ?>
<script type="text/javascript" src="login.js"></script>
