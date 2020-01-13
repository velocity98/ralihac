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
       <legend>
         Featured Hacks
       </legend>
       <hr />
       <div class='container'>
         <div class='row'>
           <div class='col-md-4'>
             <div class='card widget card-spacing'>
               <img src='images/siteimages/background.jpeg' style='width: auto; height:11rem;'/>
               <div class='card-header'>
                 <span>Test</span>
               </div>
               <div class='card-body'>

               </div>
               <div class='card-footer text-secondary'>
                 <a class='fas fa-thumbs-up'> 2</a>
               </div>
             </div>
           </div>
         </div>
       </div>
       <br />
       <div class='d-flex'>
         <div class='mr-auto'>
           <legend>
             Latest Hacks
           </legend>
         </div>
         <div class='owl-nav'>
           <a href='#' class='text-info btn btn-default border border-info view-hover'>All</a>
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
            $conn = $db->query("SELECT * FROM hack_db ORDER BY hack_id DESC LIMIT 6");

          ?>
          <?php while ($row = mysqli_fetch_assoc($conn)):
            $hack_id = $row['hack_id'];
            $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
            $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
            ?>
        <div class='owl-item'>
          <div class='col-md-12'>
            <div class='card widget card-spacing' id='card-hack'>
              <img src='<?php echo trim_image_string($row['hack_image'])?>' style='width: auto; height:11rem;'/>
              <div class='card-header'>
                <b><?php echo $row['hack_name']?></b>
              </div>
              <div class='card-body'>
                <p>
                  <?php echo $row['hack_description']?>
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
          <a href='trd.php' class='text-info btn btn-default border border-info view-hover'>All</a>
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
              <img src='<?php echo trim_image_string($row['hack_image'])?>' style='width: auto; height:11rem;'/>
              <div class='card-header'>
                <b><?php echo $row['hack_name']?></b>
              </div>
              <div class='card-body'>
                <p>
                  <?php echo $row['hack_description']?>
                </p>
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
