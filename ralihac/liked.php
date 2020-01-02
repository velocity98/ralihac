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
     <div class="card widget" style="margin-top: 3rem; margin-bottom: 1rem;">
       <div class="card-header">
         <h5 style='margin: 1px;'>My Profile</h5>
       </div>
       <div class="card-body">
         <a href='ah.php' class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Add New Hack</a>
         <a href='liked.php' class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Liked Hacks</a>
         <a href='saved.php' class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Saved Hacks</a>
         <a href='pd.php' class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Pending Approval</a>
       </div>
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
