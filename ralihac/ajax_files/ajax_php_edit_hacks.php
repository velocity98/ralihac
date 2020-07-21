<?php
  require_once '../system/initialize.php';

    if(isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['category'])):
      $hackId = sanitize($_POST['id']);
      $hackName = sanitize($_POST['name']);
      $hackCategory = sanitize($_POST['category']);
      $hackDescription = sanitize($_POST['description']);

      $query = ("UPDATE hack_db SET hack_name = ?, hack_category = ?, hack_description = ? WHERE hack_id = ?");
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssi', $hackName, $hackCategory, $hackDescription, $hackId);
        $stmt->execute();
        $stmt->close();

    $results[] = array(
      'name' => $hackName,
      'category' => $hackCategory,
      'description' => nl2br($hackDescription)
      );

      print_r(json_encode($results));
    endif;
?>
