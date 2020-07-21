<?php
require_once 'system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
 ?>
 <div class="container">
   <div class="row row-margin">
     <div class="col-md-3">
       <div class='stick'>
         <?php
          include 'includes/randWidget.php';
         ?>
        </div>
     </div>

     <div class='col-md-9'>
       <?php
       if (isset($_GET['category'])):
       $categoryName = sanitize($_GET['category']);
       $query = ("SELECT * FROM category_db WHERE category_name = ?");
       $stmt = $db->prepare($query);
       $stmt->bind_param('s', $categoryName);
       $stmt->execute();
       $stmtResult = $stmt->get_result();
        if($stmtResult->num_rows == 0){
          echo 'error';
        }
        else{
        ?>
      <legend>
        <?php echo ucwords($categoryName).' Hacks'?>
      </legend>
      <hr />
      <div class='container'>
        <div class='row'>
          <?php
            $conn = ("SELECT * FROM hack_db WHERE (hack_category = ? AND hack_archive = ?) ORDER BY hack_id DESC");
            $flag = 0;
            $stmt = $db->prepare($conn);
            $stmt->bind_param('si', $categoryName, $flag);
            $stmt->execute();
            $stmtResult = $stmt->get_result();
            if($stmtResult->num_rows == 0):
              echo "<span class='no-item text-danger text-justify d-block col-md-12'><i class='fas fa-exclamation-circle'></i> There are no ".ucwords($categoryName)." Hacks yet, try to come back again next time</span>";
            else:
            while ($row = mysqli_fetch_assoc($stmtResult)):
            $hack_id = $row['hack_id'];
            $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
            $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
            ?>
          <div class='col-6 col-md-4'>
            <div class='card widget card-spacing' id='card-hack'>
              <div class='card card-holder'>
                <img src='<?php echo trim_image_string($row['hack_image'])?>' onclick='hackModal(<?= $row['hack_id']?>)'/>
              </div>
              <div class='card-body card-body-css p-3' >
                <div class='mb-2'>
                    <h5><b><?php echo $row['hack_name']?></b></h5>
                </div>
                <div class='card-text my-auto'>
                      <?php echo nl2br($row['hack_description']);?>

                </div>
              </div>
              <div class='card-footer'>
                <button onclick='likeButton(<?php echo $row['hack_id']?>)' class='fas fa-thumbs-up
                <?php
                $store = false;
                while ($rowLikes = mysqli_fetch_assoc($likeQuery)) {
                  if($rowLikes['user_id'] == $user_id){
                    $store = true;
                  }
                }
                echo ($store == true) ? 'text-primary' : 'text-secondary';
                ?>
                  like-button float-left' id='likeButton<?php echo $row['hack_id']?>'> <span id='likeCount<?php echo $row['hack_id']?>'><?php echo mysqli_num_rows($likeQuery)?></span></button>
                <button onclick='saveButton(<?php echo $row['hack_id']?>)' class='fas fa-bookmark
                  <?php
                  $storeSaved = false;
                  while ($rowLikes = mysqli_fetch_assoc($saveQuery)) {
                    if($rowLikes['user_id'] == $user_id){
                      $storeSaved = true;
                    }
                  }
                  echo ($storeSaved == true) ? 'text-success' : 'text-secondary';
                   ?>
                  like-button float-right' id='saveButton<?php echo $row['hack_id']?>'><span id='saveStatus<?php echo $row['hack_id']?>'><?php echo ($storeSaved == true ? ' Saved' : ' Save')?></span></button>
              </div>
            </div>
          </div>
        <?php
        endwhile;
        endif;
        }
      else:
        // add redirect restriction
        endif;
        ?>
        </div>
      </div>
     </div>
   </div>
 </div>
<?php
include 'includes/footer.php';
 ?>
<script type='text/javascript' src='index.js'></script>
