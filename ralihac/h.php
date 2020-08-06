<?php
require_once 'system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
include 'includes/explicitModal.php';
include 'includes/loadingModal.php';
include 'includes/updatedHackModal.php';
 ?>
<div class='container text-break'>

     <div class="row row-margin">

       <div class="col-md-3">

         <div class='stick'>
           <?php
            include 'includes/randWidget.php';
           ?>
          </div>

         </div>



      <div class='col-md-5 my-5'>

        <div class='black-container widget '>

          <?php
            if (isset($_GET['hid'])){
              $hackId = sanitize($_GET['hid']);
              $query =
              ("SELECT hack_db.*, user_db.user_username FROM hack_db
                LEFT JOIN user_db ON hack_db.user_id = user_db.user_id
                WHERE hack_db.hack_id = ? AND hack_archive = ?;
              ");
              $flag = 0;
              $stmt = $db->prepare($query);
              $stmt->bind_param('ii', $hackId, $flag);
              $stmt->execute();
              $stmtResult = $stmt->get_result();

              if($stmtResult->num_rows == 0){

                echo("<script>location.href = 'index.php';</script>");
                exit;

              }

            }
            $row = mysqli_fetch_assoc($stmtResult);

            $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hackId");
            $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hackId");
          ?>

            <div class="d-flex h-100 justify-content-center" >
              <img class='img-responsive' id='image' src="<?php echo trim_image_string($row['hack_image'])?>" style="height: 100%; max-width:100%; z-index: 2;">
            </div>

        </div>

        <br />

        <h4 id='hackNameModify'><?php echo $row['hack_name']?></h4>

          <h6 id='hackCategoryModify' class='text-info'><a href="cg.php?category=<?php echo strtolower($row['hack_category']); ?>"> <?php echo $row['hack_category']?></a></h6>
          <h6 class='text-secondary p-0 m-0'>Uploaded By: <?php echo (!empty($row['user_username']) ? ucfirst($row['user_username']) : 'Ralihac' )?></h6>
          <h6 class='d-inline text-secondary p-0 m-0'><?php echo timeAgo($row['hack_date'])?></h6>
          <div class='mt-2'>
              <div class='d-flex'>
                <div class='text-left'>
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
                </div>

                  <div class='text-left mx-3'>
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
                      like-button' id='allSaveButton<?php echo $row['hack_id']?>'><span id='allSaveStatus<?php echo $row['hack_id']?>'><?php echo ($storeSaved == true ? ' Saved' : ' Save')?></span></button>
                  </div>
                  <?php if ($user_id == $row['user_id'] && $user_id != 0): ?>
                  <div class='ml-auto'>
                      <button onclick='editHackModal(<?php echo $row['hack_id']?>)'  class='btn btn-outline-secondary btn-sm'>Edit</button>
                      <button onclick='deleteHackModal(<?php echo $row['hack_id']?>)' class='btn btn-outline-danger btn-sm'>Delete</button>
                  </div>
                  <?php endif;?>
              </div>


          </div>
        <hr />
        <div class='textbox-custom overflow-auto'>
          <h5 id='hackDescriptionModify'><?php echo nl2br($row['hack_description'])?></h5>
        </div>

      </div>

      <div class='col-md-4 my-5'>

        <h5>Recommended Hacks</h5>
        <hr />
        <?php
          $recommendedCategory = $row['hack_category'];
          $currentHackId = $hackId;
          $query =
            ("SELECT hack_db.*, user_db.user_username
             FROM hack_db
             LEFT JOIN user_db ON hack_db.user_id = user_db.user_id
             WHERE hack_db.hack_category = ? AND hack_db.hack_id != ? ORDER BY RAND() LIMIT 6");
          $stmt = $db->prepare($query);
          $stmt->bind_param('ss', $recommendedCategory, $currentHackId);
          $stmt->execute();
          $stmtResult = $stmt->get_result();

          while ($row = $stmtResult->fetch_assoc()):
         ?>
        <div class='col-12 mb-3 p-0 text-break'>

            <div class='recommended d-flex' onclick="location.href='h.php?hid=<?php echo $row['hack_id']?>';">

              <div class='p-0 recommendedImage'>
                  <img class='img-responsive' src="<?php echo trim_image_string($row['hack_image'])?>" style="height: 6rem; width:10rem;">
              </div>

              <div class='col'>
                <h6 class='recommendedEllipsis' data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['hack_name']?>" ><b><?php echo $row['hack_name']?></b></h6>
                <h6 class='m-0'><small class='text-muted'><?php echo (!empty($row['user_username']) ? ucfirst($row['user_username']) : 'Ralihac' )?></small></h6>
                <?php
                  $hack_id = $row['hack_id'];
                  $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
                ?>
                <small class='text-muted'><?php echo (mysqli_num_rows($likeQuery) == 1 ) ? mysqli_num_rows($likeQuery).' Like' : mysqli_num_rows($likeQuery).' Likes' ?> &#8226; <?php echo timeAgo($row['hack_date'])?></small>
              </div>

            </div>



        </div>
      <?php endwhile;?>

     </div>

    </div>
</div>

 <?php
 include 'includes/footer.php';
  ?>
