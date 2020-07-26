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
       <div class='d-flex'>
         <div class='mr-auto'>
           <legend>
             Featured Hacks
           </legend>
         </div>
         <div class='owl-nav'>
           <button class="owl-prev-three text-light btn btn-info border border-dark"><i class='fas fa-arrow-left'></i></button>
           <button class="owl-next-three text-light btn btn-info border border-dark"><i class='fas fa-arrow-right'></i></button>
         </div>
       </div>

       <hr />
<!-- here -->
       <div class='container'>
         <div class='row'>
           <div id='owl-one' class='owl-carousel owl-theme owl-loaded'>
             <div class="owl-stage-outer">
               <div class="owl-stage">
           <?php
             $conn = $db->query("SELECT * FROM hack_db WHERE (hack_featured = 1 AND hack_archive = 0) ORDER BY hack_id DESC LIMIT 6");

           ?>
           <?php while ($row = mysqli_fetch_assoc($conn)):
             $hack_id = $row['hack_id'];
             $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
             $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
             ?>
         <div class='owl-item'>
           <div class='col-md-12'>
             <div class='card widget card-spacing' id='card-hack'>
               <div class='card card-holder'>
                 <img src='<?php echo trim_image_string($row['hack_image'])?>' onclick='hackModal(<?= $row['hack_id']?>)' />
               </div>


                  <div class='card-body card-body-css p-3' >
                    <div class='mb-2'>
                        <h5><b><?php echo $row['hack_name']?></b></h5>
                    </div>
                    <div class='card-text my-auto text-muted'>
                          <?php echo nl2br($row['hack_description']);?>

                    </div>
                  </div>


               <div class='card-footer'>
                 <button onclick='featuredLikeButton(<?php echo $row['hack_id']?>)' class='fas fa-thumbs-up
                 <?php
                 $store = false;
                 while ($rowLikes = mysqli_fetch_assoc($likeQuery)) {
                   if($rowLikes['user_id'] == $user_id){
                     $store = true;
                   }
                 }
                 echo ($store == true) ? 'text-primary' : 'text-secondary';
                 ?>
                   like-button float-left' id='featuredLikeButton<?php echo $row['hack_id']?>' > <span id='featuredLikeCount<?php echo $row['hack_id']?>'><?php echo mysqli_num_rows($likeQuery)?></span></button>
                 <button onclick='featuredSaveButton(<?php echo $row['hack_id']?>)' class='fas fa-bookmark
                   <?php
                   $storeSaved = false;
                   while ($rowLikes = mysqli_fetch_assoc($saveQuery)) {
                     if($rowLikes['user_id'] == $user_id){
                       $storeSaved = true;
                     }
                   }
                   echo ($storeSaved == true) ? 'text-success' : 'text-secondary';
                    ?>
                   like-button float-right' id='featuredSaveButton<?php echo $row['hack_id']?>'><span id='featuredSaveStatus<?php echo $row['hack_id']?>'><?php echo ($storeSaved == true ? ' Saved' : ' Save')?></span></button>
               </div>
             </div>
           </div>
         </div>
         <?php
         endwhile;
         ?>
               </div>
             </div>
           </div>
         </div>
       </div>
<!-- to here -->
       <br />
       <div class='d-flex'>
         <div class='mr-auto'>
           <legend>
             Latest Hacks
           </legend>
         </div>
         <div class='owl-nav'>
           <a href='latest.php' class='btn btn-outline-info'>All</a>
           <button class="owl-prev-two text-light btn btn-info border border-dark"><i class='fas fa-arrow-left'></i></button>
           <button class="owl-next-two text-light btn btn-info border border-dark"><i class='fas fa-arrow-right'></i></button>
         </div>
       </div>
      <hr />
      <div class='container'>
        <div class='row'>
          <div id='owl-two' class='owl-carousel owl-theme owl-loaded'>
            <div class="owl-stage-outer">
              <div class="owl-stage">
          <?php
            $conn = $db->query("SELECT * FROM hack_db WHERE (hack_archive = 0) ORDER BY hack_id DESC LIMIT 6");

          ?>
          <?php while ($row = mysqli_fetch_assoc($conn)):
            $hack_id = $row['hack_id'];
            $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
            $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
            ?>
        <div class='owl-item'>
          <div class='col-md-12'>
            <div class='card widget card-spacing' id='card-hack'>
              <div class='card card-holder'>
                <img src='<?php echo trim_image_string($row['hack_image'])?>' onclick='hackModal(<?= $row['hack_id']?>)'/>
              </div>
              <div class='card-body card-body-css p-3' >
                <div class='mb-2'>
                    <h5><b><?php echo $row['hack_name']?></b></h5>
                </div>
                <div class='card-text my-auto text-muted'>
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
        </div>
        <?php
        endwhile;
        ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <br />

      <div class='d-flex'>
        <div class='mr-auto'>
          <legend>
            Trending
          </legend>
        </div>
        <div class='owl-nav'>
          <a href='trd.php' class='btn btn-outline-info'>All</a>
          <button class="owl-prev text-light btn btn-info border border-dark"><i class='fas fa-arrow-left'></i></button>
          <button class="owl-next text-light btn btn-info border border-dark"><i class='fas fa-arrow-right'></i></button>
        </div>
      </div>
      <hr />
      <div class='container'>
        <div class='row'>
          <div id='owl-three' class='owl-carousel owl-theme owl-loaded'>
            <div class="owl-stage-outer">
      <div class="owl-stage">
          <?php
            $connection = $db->query(
              "SELECT * FROM like_db
                LEFT JOIN hack_db
                ON like_db.hack_id = hack_db.hack_id
                WHERE (hack_archive = 0)
                GROUP BY like_db.hack_id
                ORDER BY count(*) DESC
                LIMIT 6");
          ?>
          <?php while ($row = mysqli_fetch_assoc($connection)):
            $hack_id = $row['hack_id'];
            $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
            $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
            ?>
            <div class='owl-item'>
          <div class='col-md-12'>
            <div class='card widget card-spacing' id='card-hack'>
              <div class='card card-holder'>
                <img src='<?php echo trim_image_string($row['hack_image'])?>' onclick='hackModal(<?= $row['hack_id']?>)' />
              </div>
              <div class='card-body card-body-css p-3' >
                <div class='mb-2'>
                    <h5><b><?php echo $row['hack_name']?></b></h5>
                </div>
                <div class='card-text my-auto text-muted'>
                      <?php echo nl2br($row['hack_description']);?>

                </div>
              </div>
              <div class='card-footer'>
                <button onclick='mostLikeButton(<?php echo $row['hack_id']?>)' class='fas fa-thumbs-up
                <?php
                $store = false;
                while ($rowLikes = mysqli_fetch_assoc($likeQuery)) {
                  if($rowLikes['user_id'] == $user_id){
                    $store = true;
                  }
                }
                echo ($store == true) ? 'text-primary' : 'text-secondary';
                ?>
                like-button float-left' id='mostLikeButton<?php echo $row['hack_id']?>'> <span id='mostLikeCount<?php echo $row['hack_id']?>'><?php echo mysqli_num_rows($likeQuery)?></span></button>
                <button onclick='mostSaveButton(<?php echo $row['hack_id']?>)' class='fas fa-bookmark
                <?php
                $storeSaved = false;
                while ($rowLikes = mysqli_fetch_assoc($saveQuery)) {
                  if($rowLikes['user_id'] == $user_id){
                    $storeSaved = true;
                  }
                }
                echo ($storeSaved == true) ? 'text-success' : 'text-secondary';
                 ?>
                like-button float-right' id='mostSaveButton<?php echo $row['hack_id']?>'><span id='mostSaveStatus<?php echo $row['hack_id']?>'><?php echo ($storeSaved == true) ? ' Saved' : ' Save'?></span></button>
              </div>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
</div>
</div>
  </div>
        </div>
      </div>

     </div>
   </div>


 </div>
<?php
include 'includes/footer.php';
 ?>
<script type='text/javascript' src='index.js'></script>
