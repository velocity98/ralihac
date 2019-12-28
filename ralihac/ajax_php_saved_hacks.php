<?php
  require_once 'system/initialize.php';
  if(isset($_POST)){
    $id = sanitize($_POST['id']);
    $savedArray = [];
    $query = ("SELECT * FROM hack_db WHERE hack_id = ?");
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

      if(empty($row['hack_saved_users']) == true){
        $savedArray[] = array(
          'user_id' => $user_id,
          'saved_status' => true
        );
        $jsonSavedArray = json_encode($savedArray);
        $updateQuery = ("UPDATE hack_db SET hack_saved_users = ?  WHERE hack_id = ?");
        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param('si', $jsonSavedArray, $id);
        $stmt->execute();
        $stmt->close();
        return print('saved');
      }
      else{
        $jsonArray = json_decode($row['hack_saved_users'], true);
        $i = 0;
        foreach ($jsonArray as $key) {
          if($jsonArray[$i]['user_id'] == $user_id){
            unset($jsonArray[$i]);
            $updateQuery = ("UPDATE hack_db SET hack_saved_users = ? WHERE hack_id = ?");
            $jsonEncode = json_encode($jsonArray);
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param('si', $jsonEncode, $id);
            $stmt->execute();
            $stmt->close();
            return print('removed');
          }
          $i++;
        }
          $jsonArray[] = array(
           'user_id' => $user_id,
           'saved_status' => true
          );
          $jsonEncode = json_encode($jsonArray);
          $updateQuery = ("UPDATE hack_db SET hack_saved_users = ? WHERE hack_id = ?");
          $stmt = $db->prepare($updateQuery);
          $stmt->bind_param('si', $jsonEncode, $id);
          $stmt->execute();
          $stmt->close();
          return print('saved');
      }
  }
 ?>
