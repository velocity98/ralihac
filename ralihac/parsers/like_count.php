<?php
  require_once '../system/initialize.php';
  $query = $db->query("SELECT * FROM like_db WHERE user_id = $user_id");
  $number_of_rows = mysqli_num_rows($query);
  return print("(".$number_of_rows.")");
?>
