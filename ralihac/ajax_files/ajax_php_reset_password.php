<?php
require_once '../system/initialize.php';


if (isset($_POST['password']) && isset($_POST['confirmPassword'])){

    $password = sanitize($_POST['password']);
    $confirmPassword = sanitize($_POST['confirmPassword']);
    $selector = sanitize($_POST['selector']);
    $validator = sanitize($_POST['validator']);

    $currentDate = date("Y-m-d H:i:s");

    // open database to confirm user and get email_error

    $query = ("SELECT * FROM password_reset WHERE passwordResetSelector = ? AND passwordResetExpire >= ?");
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $selector, $currentDate);
    $stmt->execute();
    $stmtResult = $stmt->get_result();
    $row = $stmtResult->fetch_assoc();

        if($stmtResult->num_rows == 0){

          $errorArray[] = array('error' => 'Your Password Reset request has expired, please re-submit another Password Reset Request');
          return print (json_encode($errorArray));

        } else{

          $tokenBin = hex2bin($validator);
          $tokenCheck = password_verify($tokenBin, $row['passwordResetToken']); // true or false

            if ($tokenCheck === false){

              $errorArray[] = array('error' => 'You need to re-submit your Password Reset Request');
              return print (json_encode($errorArray));

            } elseif ($tokenCheck === true){

              $tokenEmail = $row['passwordResetEmail'];
              $query = ("SELECT * FROM user_db WHERE user_email = ?");

              $stmt = $db->prepare($query);
              $stmt->bind_param('s', $tokenEmail);
              $stmt->execute();
              $stmtResult = $stmt->get_result();

              if($stmtResult->num_rows == 0){

                $errorArray[] = array('error' => 'You do not Exist!');
                return print (json_encode($errorArray));

              } else {

                $query = ("UPDATE user_db SET user_password = ? WHERE user_email = ?");
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare($query);
                $stmt->bind_param('ss', $hashedPassword, $tokenEmail);
                $stmt->execute();

                $query = ("DELETE FROM password_reset WHERE passwordResetEmail = ?");
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $tokenEmail);
                $stmt->execute();

                // reset password Successful!
                $successArray[] = array('success' => 'reset');
                return print (json_encode($successArray));

              }


            }

        }

}else{

  header('Location: ../index.php');
  exit;

}

?>
