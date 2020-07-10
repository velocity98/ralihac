<?php
require_once 'system/initialize.php';
include 'includes/head.php';
include 'includes/nav.php';
 ?>
 <div class="container">
   <div class="row row-margin">
     <div class="col-md-3">
       <div class='stick'>
         <div class="card widget" style="margin-top: 3rem; margin-bottom: 1rem; ">
           <div class="card-header">
             <h5 style='margin: 1px;'>Welcome to Ralihac</h5>
           </div>
           <div class="card-body">
             <span>Try Ralihac's Randomize &nbsp</span><a class="fas fa-info-circle text-info"></a>
             <button class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Randomize</button>
           </div>
         </div>
        </div>
     </div>

     <div class='col-md-9'>
       <?php
       if (isset($_GET['q'])):
         $_GET['q'] = trim(preg_replace('!\s+!', ' ', $_GET['q'])); // no extra white space in query
         if($_GET['q'] == null){
           ?>
           <legend>
             <?php echo 'Search results'?>
           </legend>
           <hr />
           <?php
            echo "<span class='no-item text-danger text-justify d-block col-md-12'><i class='fas fa-exclamation-circle'></i> No Hacks found, try searching a different Hack</span>";
         }
         else{
       $searchQuery = sanitize("%{$_GET['q']}%");
       $searchName = sanitize($_GET['q']);
       $conn = ("SELECT hack_db.*, user_db.user_username FROM hack_db
         LEFT JOIN user_db ON hack_db.user_id = user_db.user_id WHERE hack_db.hack_name LIKE ? OR hack_db.hack_description LIKE ? OR user_db.user_username LIKE ? OR hack_db.hack_category LIKE ?");
       $stmt = $db->prepare($conn);
       $stmt->bind_param('ssss', $searchQuery, $searchQuery, $searchQuery, $searchQuery);
       $stmt->execute();
       $stmtResult = $stmt->get_result();
        ?>
      <legend>
        <?php echo 'Search results of "'.ucwords($searchName).'" <span class="text-info">('.$stmtResult->num_rows.')</span>'?>
      </legend>
      <hr />
      <div class='container'>
        <div class='row'>
          <?php
          if($stmtResult->num_rows == 0){
            echo "<span class='no-item text-danger text-justify d-block col-md-12'><i class='fas fa-exclamation-circle'></i> There are no Hacks named ".ucwords($searchName)." yet, try searching a different Hack</span>";
          }
          else{
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
              <div class='card-header'>
                <b><?php echo $row['hack_name']?></b>
              </div>
              <div class='card-body card-body-css'>
                <p>
                  <?php echo custom_echo($row['hack_description'], 56, $hack_id)?>
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
        }
      }
      else:
        // add redirect
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
