<?php
  require_once '../system/initialize.php';
    if(isset($_POST['id'])):
      $hackId = sanitize($_POST['id']);
      $flag = 1;
      $query = ("UPDATE hack_db SET hack_archive = ? WHERE hack_id = ?");
        $stmt = $db->prepare($query);
        $stmt->bind_param('ii', $flag, $hackId);
        $stmt->execute();
        $stmt->close();
    endif;
    echo $hackId;
?>
