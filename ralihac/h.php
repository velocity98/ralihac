<?php
require_once 'system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
 ?>

<div class='container text-break'>
  <div class='row row-margin ml-1 mr-1'>

    <div class='col-md-8 col-12 black-container'>
      <?php
        if (isset($_GET['hid'])){
          $hackId = sanitize($_GET['hid']);
          $query =
          ("SELECT hack_db.*, user_db.user_username FROM hack_db
            LEFT JOIN user_db ON hack_db.user_id = user_db.user_id
            WHERE hack_db.hack_id = ?
          ");
          $stmt = $db->prepare($query);
          $stmt->bind_param('i', $hackId);
          $stmt->execute();
          $stmtResult = $stmt->get_result();
        }
        $row = mysqli_fetch_assoc($stmtResult);

        $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hackId");
        $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hackId");
      ?>

        <div class="d-flex h-100 justify-content-center" >
          <img class='img-responsive' src="<?php echo trim_image_string($row['hack_image'])?>" style="height: 100%; max-width:100%; z-index: 2;">
        </div>

    </div>
    <div class='col-md-4 col-12 title-size'>

      <h1><b><?php echo $row['hack_name']?></b></h1>
      <h5 class='text-secondary'>Uploaded By: <?php echo $row['user_username']?></h5>
      <h5 class='text-secondary'><?php echo date_format(date_create($row['hack_date']), "m-d-Y")?></h5>
      <hr />
      <div class='textbox-custom overflow-auto'>
        <h6><?php echo $row['hack_description']?></h6>

        </p>
      </div>

      <hr />
      <div class='d-inline'>
        <button onclick='allLikeButton(<?php echo $row['hack_id']?>)' class='fas fa-thumbs-up
        <?php
        $store = false;
        while ($rowLikes = mysqli_fetch_assoc($likeQuery)) {
          if($rowLikes['user_id'] == $user_id){
            $store = true;
          }
        }
        echo ($store == true) ? 'text-primary' : 'text-secondary';
        ?>
          like-button' id='allLikeButton<?php echo $hackId?>'> <span id='allLikeCount<?php echo $hackId?>'><?php echo mysqli_num_rows($likeQuery)?></span></button>
          <button onclick='allSaveButton(<?php echo $row['hack_id']?>)' class='fas fa-bookmark
            <?php
            $storeSaved = false;
            while ($rowLikes = mysqli_fetch_assoc($saveQuery)) {
              if($rowLikes['user_id'] == $user_id){
                $storeSaved = true;
              }
            }
            echo ($storeSaved == true) ? 'text-success' : 'text-secondary';
             ?>
            like-button ' id='allSaveButton<?php echo $row['hack_id']?>'><span id='allSaveStatus<?php echo $row['hack_id']?>'><?php echo ($storeSaved == true ? ' Saved' : ' Save')?></span></button>
      </div>
    </div>
  </div>
</div>

 <?php
 include 'includes/footer.php';
  ?>
