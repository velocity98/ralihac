<?php
  require_once '../system/initialize.php';
  $query = $db->query("SELECT * FROM save_db
    LEFT JOIN hack_db
    ON save_db.hack_id = hack_db.hack_id
    WHERE save_db.user_id = $user_id AND hack_db.hack_archive = 0");
  $number_of_rows = mysqli_num_rows($query);
  return print("(".$number_of_rows.")");
?>
