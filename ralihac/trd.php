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
            Trending Hacks
          </legend>
        </div>
      </div>
      <hr />
      <div class='container'>
        <div class='row view-liked'>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include 'includes/footer.php';
?>
<script type='text/javascript' src='trending.js'></script>
