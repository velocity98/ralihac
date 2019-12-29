<?php
  require_once 'system/initialize.php';
  $date = date("Y-m-d H:i:s");
  if(isset($_POST)){
    $hack_id = sanitize($_POST['id']);
    $query = $db->query("SELECT * FROM save_db");
    while($row = mysqli_fetch_array($query)){
      if($row['hack_id'] == $hack_id && $row['user_id'] == $user_id){
        $stmt = $db->prepare("DELETE FROM save_db WHERE hack_id = ? AND user_id = ?");
        $stmt->bind_param('ii', $hack_id, $user_id);
        $stmt->execute();
        $stmt->close();
        return print('removed');
      }
    }
    $insertQuery = ("INSERT INTO save_db (user_id, save_date, hack_id) VALUES (?,?,?)");
    $stmt = $db->prepare($insertQuery);
    $stmt->bind_param('isi', $user_id, $date, $hack_id);
    $stmt->execute();
    $stmt->close();
    return print('saved');
  }
 ?>
