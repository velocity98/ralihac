<?php
require_once 'system/initialize.php';
if (isset($_POST)){
  $username = sanitize($_POST['username']);
  $username = trim($username);
  $password = sanitize($_POST['password']);
  $password = trim($password);
  $confirmPassword = sanitize($_POST['confirmPassword']);
  $confirmPassword = trim($confirmPassword);
  $email = sanitize($_POST['email']);
  $email = trim($email);
  $hash = password_hash($confirmPassword, PASSWORD_DEFAULT);
  $userCreate = date("Y-m-d H:i:s");
  $userHacks = '[]';
  $errorArray = [];
  $successArray = [];
  $confirmQuery = ("SELECT * FROM user_db");
  $resultUsers = $db->query($confirmQuery);
    while($row = mysqli_fetch_assoc($resultUsers)){
      if ($username == $row['user_username']){
        $errorArray[] = array('error' => 'Username has already been taken');
      }
      if ($email == $row['user_email']){
        $errorArray[] = array('error' => 'Email has already been used');
      }
    }
    if(count($errorArray) > 0){
      echo json_encode($errorArray);
    }
    else{
      $query = ("INSERT INTO user_db (user_username, user_password, user_email, user_create, user_lastlogin, user_hacks) VALUES (?,?,?,?,?,?)");
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssssss', $username, $hash, $email, $userCreate, $userCreate, $userHacks);
        $stmt->execute();
      $loginQuery = ("SELECT * FROM user_db WHERE user_username = ?"); // Query to login after creating Account
        $stmt = $db->prepare($loginQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
          user_login($user_id);
          $stmt->close();
      $successArray[] = array('success' => 'Login');
      echo json_encode($successArray);
    }
}
 ?>
