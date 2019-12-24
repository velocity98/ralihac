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
       <br />
      <legend>
        New Hacks
      </legend>
      <hr />

      <div class='row'>
        <?php
          $conn = $db->query("SELECT * FROM hack_db ORDER BY hack_id DESC LIMIT 6");
        ?>
        <?php while ($row = mysqli_fetch_assoc($conn)): ?>
        <div class='col-md-4'>
          <div class='card widget card-spacing'>
            <img src='<?php echo trim_image_string($row['hack_image'])?>' style='width: auto; height:11rem;'/>
            <div class='card-header'>
              <span><?php echo $row['hack_name']?></span>
            </div>
            <div class='card-body'>
              <p>
                <?php echo $row['hack_description']?>
              </p>
            </div>
            <div class='card-footer'>
              <button onclick='likeButton(<?php echo $row['hack_id']?>)' class='fas fa-thumbs-up text-secondary like-button' id='likeButton'> <span id='likeCount'>2</span></button>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
      </div>
      <br />

      <legend>
        Most Liked Hacks
      </legend>
      <hr />
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

   </div>
 </div>
<?php
include 'includes/footer.php';
 ?>
<script type='text/javascript' src='index.js'></script>
