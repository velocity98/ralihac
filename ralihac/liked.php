<?php
require_once 'system/initialize.php';
if (is_logged_in_user() == false){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
?>
<div class="container">
  <div class="row row-margin">
    <div class="col-md-3">
      <div class='stick'>
        <?php
         include 'includes/randWidget.php';
         include 'includes/profileWidget.php';
        ?>
      </div>
    </div>

    <div class='col-md-9'>
      <div class='d-flex'>
        <div class='mr-auto'>
          <legend>
            Liked <span id='allLikes' class='text-info'></span>
          </legend>
        </div>
      </div>
      <hr />
      <div class='container '>
        <div class='row view-liked'>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include 'includes/footer.php';
?>
<script type='text/javascript' src='liked.js'></script>
