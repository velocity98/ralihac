<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/ralihac/system/initialize.php';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ralihac Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="adminstyle.css">
  </head>
  <body>
    <div class="supercontainer">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8 offset-md-2 loginstyle">
          <div class="d-flex justify-content-center h-100">
          		<div class="card card-style">
          			<div class="card-header">
          				<h3 class="text-light text-center">Administration</h3>
          			</div>
                <?php
                $user = ((isset($_POST['username']))?sanitize($_POST['username']):'');
                $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');

                if($_POST){
                    $userquery = ("SELECT * FROM admin WHERE admin_username = ? ");
                    $stmt = $db->prepare($userquery);
                    $stmt->bind_param('s', $user);
                    $stmt->execute();
                    $result = $stmt ->get_result();
                    $row = $result->fetch_assoc();
                    if(!password_verify($password, $row['admin_password'])){

                      echo "<script>
                      alert('Username and/or Password is Incorrect');
                      </script>";
                      $user = null;
                      $password = null;

                    }
                    else{
                      $admin_id = $row['admin_id'];
                      login($admin_id);
                    }
                  }
                 ?>
                <!-- <div class="text-danger text-center" id="both_error"></div> -->
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
          						<input type="submit" value="Login" class="btn btn-info btn-block">
          					</div>
          				</form>

          			</div>

          		</div>

          	</div>
      </div>
    </div>
  </div>
</div>
  </body>

  <footer></footer>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="login.js"></script>
