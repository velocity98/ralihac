<?php
if(isset($_POST)){
  $username = sanitize($_POST['username']);
  $username = trim($username);
  $loginQuery = ("SELECT * FROM user_db WHERE user_username = $username"); // Query to login after creating Account
    $result = $db->query($loginQuery);
    $row = mysqli_fetch_assoc($userData);
    $user_id = $row['user_id'];
      user_login($user_id);
}
?>
