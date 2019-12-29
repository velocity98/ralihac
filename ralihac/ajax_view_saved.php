<?php
// only view saved hacks, not submitting anything
require_once 'system/initialize.php';

  $connection = $db->query(
    "SELECT * FROM save_db
      LEFT JOIN hack_db
      ON save_db.hack_id = hack_db.hack_id
      WHERE save_db.user_id = $user_id
      ORDER BY save_db.save_date DESC
      LIMIT 3"
    );
  $output = '';
 while ($row = mysqli_fetch_assoc($connection)){
  $hack_id = $row['hack_id'];
  $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
  $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
    $output .= "
    <div class='col-md-4'>
      <div class='card widget card-spacing' id='card-hack'>
        <img src='".trim_image_string($row['hack_image'])."' style='width: auto; height:11rem;'/>
        <div class='card-header'>
          <b>".$row['hack_name']."</b>
        </div>
        <div class='card-body'>
          <p>
            ".$row['hack_description']."
          </p>
        </div>
        <div class='card-footer'>
          <button onclick='mostLikeButton(".$row['hack_id'].")' class='fas fa-thumbs-up
          ";
          $store = false;
          while ($rowLikes = mysqli_fetch_assoc($likeQuery)) {
            if($rowLikes['user_id'] == $user_id){
              $store = true;
            }
          }
        $output .= ($store == true) ? ' text-primary ' : ' text-secondary ';
        $output.=
          "like-button float-left' id='mostLikeButton".$row['hack_id']."'> <span id='mostLikeCount".$row['hack_id']."'>".mysqli_num_rows($likeQuery)."</span></button>
          <button onclick='mostSaveButton(".$row['hack_id'].")' class='fas fa-ban
          ";
          $storeSaved = false;
          while ($rowLikes = mysqli_fetch_assoc($saveQuery)) {
            if($rowLikes['user_id'] == $user_id){
              $storeSaved = true;
            }
          }
        $output .= ($storeSaved == true) ? ' text-danger ' : ' text-secondary ';
        $output .=
          "like-button float-right' id='mostSaveButton".$row['hack_id']."'><span id='mostSaveStatus".$row['hack_id']."'>";
        $output .= ($storeSaved == true) ? ' Remove' : ' Save ';
        $output .="</span></button>
        </div>
      </div>
    </div>";
}
if ($output == ''){
  echo $output .= "<span class='no-item text-danger text-justify d-block col-md-12'><i class='fas fa-exclamation-circle'></i> You haven't saved any hacks yet</span>";
}else{
  echo $output;
}
?>
