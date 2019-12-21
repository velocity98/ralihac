<?php
require_once 'system/initialize.php';
if (isset($_POST)){
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $userquery = ("SELECT * FROM user_db WHERE user_username = ? ");
    $stmt = $db->prepare($userquery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $errorArray = [];
    $successArray = [];

    if(!password_verify($password, $row['user_password'])){
      $errorArray[] = array('error' => 'Username or Password is Incorrect');
    }

    if(count($errorArray) > 0){
      echo json_encode($errorArray);
    }
    else{
      $user_id = $row['user_id'];
      user_login($user_id);
      $stmt->close();
      $successArray[] = array('success' => 'Login');
      echo json_encode($successArray);
    }
  }
?>
