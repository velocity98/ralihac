<?php
  require_once '../system/initialize.php';
  $date = date("Y-m-d H:i:s");
  if($user_id == null){
    return print('likeModal');
  }
  else{
    if(isset($_POST['id'])){
      $hack_id = sanitize($_POST['id']);
      $query = $db->query("SELECT * FROM like_db");
      while($row = mysqli_fetch_array($query)){
        if($row['hack_id'] == $hack_id && $row['user_id'] == $user_id){
          $stmt = $db->prepare("DELETE FROM like_db WHERE hack_id = ? AND user_id = ?");
          $stmt->bind_param('ii', $hack_id, $user_id);
          $stmt->execute();
          $stmt->close();
          return print('unliked');
        }
      }
      $insertQuery = ("INSERT INTO like_db (user_id, like_date, hack_id) VALUES (?,?,?)");
      $stmt = $db->prepare($insertQuery);
      $stmt->bind_param('isi', $user_id, $date, $hack_id);
      $stmt->execute();
      $stmt->close();
      return print('liked');
    }
  }
 ?>
