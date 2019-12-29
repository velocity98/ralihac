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
         <button class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Add New Hack</button>
         <button class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Liked Hacks</button>
         <button class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Saved Hacks</button>
         <button class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Pending Approval</button>
       </div>
     </div>
    </div>

    <div class='col-md-9'>
      <legend>
        Saved
      </legend>
      <hr />
      <div class='container '>
        <div class='row view-saved'>

        </div>
      </div>

      <br />
      <legend>
        Liked
      </legend>
      <hr />
      <div class='container '>
        <div class='row view-liked'>
          <!-- <span class='no-item text-danger text-justify d-block col-md-12'><i class='fas fa-exclamation-circle'></i> You haven't Liked any hacks yet</span> -->
        </div>
      </div>

    </div>
  </div>
</div>
<?php
include 'includes/footer.php';
?>
<script type='text/javascript' src='profile.js'></script>
