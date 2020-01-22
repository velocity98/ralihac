<?php
require_once 'system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
 ?>
 <div class="container">
   <div class="row row-margin">
     <div class="col-md-3">
      <div class="card widget" style="margin-top: 3rem; margin-bottom: 1rem;">
        <div class="card-header">
          <h5 style='margin: 1px;'>Welcome to Ralihac</h5>
        </div>
        <div class="card-body">
          <span>Try Ralihac's Randomize &nbsp</span><a class="fas fa-info-circle text-info"></a>
          <button class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Randomize</button>
        </div>
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
            $conn = ("SELECT * FROM hack_db WHERE hack_category = ? ORDER BY hack_id DESC");
            $stmt = $db->prepare($conn);
            $stmt->bind_param('s', $categoryName);
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
          <div class='col-md-4'>
            <div class='card widget card-spacing' id='card-hack'>
              <div class='card card-holder'>
                <img src='<?php echo trim_image_string($row['hack_image'])?>' style='width: auto; height:11rem;'/>
              </div>
              <div class='card-header'>
                <b><?php echo $row['hack_name']?></b>
              </div>
              <div class='card-body card-body-css'>
                <p>
                  <?php echo custom_echo($row['hack_description'], 56)?>
                </p>
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
