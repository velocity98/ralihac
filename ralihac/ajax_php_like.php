<?php
  require_once 'system/initialize.php';
  if(isset($_POST)){
    $id = sanitize($_POST['id']);
    $likeArray = [];
    $query = ("SELECT * FROM hack_db WHERE hack_id = ?");
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

      if(empty($row['hack_likes']) == true ){
        $likeArray[] = array(
          'user_id' => $user_id,
          'like_status' => true
        );
        $jsonLikeArray = json_encode($likeArray);
        $likeCount = $row['hack_likes_count'] + 1;
        $updateQuery = ("UPDATE hack_db SET hack_likes = ?, hack_likes_count = ? WHERE hack_id = ?");
        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param('sii', $jsonLikeArray, $likeCount, $id);
        $stmt->execute();
        $stmt->close();
        return print('liked');
      }
      else{ // toggle like/unlike
        $jsonArray = json_decode($row['hack_likes'], true);
        $i = 0;
        foreach ($jsonArray as $key) {
          if($jsonArray[$i]['user_id'] == $user_id){
            unset($jsonArray[$i]);
            $likeCount = $row['hack_likes_count'] - 1;
            $updateQuery = ("UPDATE hack_db SET hack_likes = ?, hack_likes_count = ? WHERE hack_id = ?");
            $jsonEncode = json_encode($jsonArray);
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param('sii', $jsonEncode, $likeCount, $id);
            $stmt->execute();
            $stmt->close();
            return print('unliked');
          }
          $i++;
        }
          $jsonArray[] = array(
           'user_id' => $user_id,
           'like_status' => true
          );
          $likeCount = $row['hack_likes_count'] + 1;
          $jsonEncode = json_encode($jsonArray);
          $updateQuery = ("UPDATE hack_db SET hack_likes = ?, hack_likes_count = ? WHERE hack_id = ?");
          $stmt = $db->prepare($updateQuery);
          $stmt->bind_param('sii', $jsonEncode, $likeCount, $id);
          $stmt->execute();
          $stmt->close();
          return print('liked');
      }
  }
 ?>
