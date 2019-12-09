<?php
require_once '../system/initialize.php';
if(!is_logged_in()){
  login_redirect();
}
include './includes/head.php';
include './includes/nav.php';
 ?>
  <div class="container" id="toggle"> <!-- show control panel and pending -->
    <div class="row align-items-center">
        <div class="col-md-6">
          <div class="d-flex justify-content-center h-100">
            <div class="card card-buttons bg-info border-primary" style="width: 18rem; height: 20rem">
              <div class="card-body text-center">
                <img src="../images/siteimages/folder.png" style="height:auto; width:85%;">
                <a href="#" class="stretched-link" onclick="clickhere()"></a>
              </div>
              <div class="card-footer text-center text-light" style="font-size: 30px; font-family: Arial, Helvetica, sans-serif;">Control Panel</div>
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex justify-content-center h-100">
          <div class="card card-buttons bg-info border-primary" style="width: 18rem; height:20rem;">
            <div class="card-body text-center">
              <img src="../images/siteimages/watch.png" style="height:auto; width:70%;">
              <a href="" class="stretched-link"></a>
            </div>
            <div class="card-footer text-center text-light" style="font-size: 30px; font-family: Arial, Helvetica, sans-serif;">Pending: 0</div>
          </div>
      </div>
    </div>
</div>
</div>


<div class="container" id="toggle2"> <!-- control panel -->


  <div class="marginedit">
  <div class="row align-items-center">

      <div class="col-md-1 ">
         <div class="d-flex jusify-content-center h-100">
        <button class="btn btn-warning border-light" style="margin-top:10%;" onclick="goback()"><i class="fas fa-arrow-left"></i></button>
      </div>
      </div>

    <div class="col-md-12">
      <div class="d-flex jusify-content-center h-100">
       <a href="hacks.php" class="btn btn-danger buttoncss btn-block border-secondary"><span class="fas fa-chalkboard"></span> Hacks</a>
     </div>
   </div>

   <div class="col-md-12">
     <div class="d-flex jusify-content-center h-100">
      <a href="categories.php" class="btn btn-danger buttoncss btn-block border-secondary"><span class="fas fa-clipboard-list"></span> Categories</a>
    </div>
  </div>

  <div class="col-md-12">
    <div class="d-flex jusify-content-center h-100">
     <button class="btn btn-danger buttoncss btn-block border-secondary"><span class="fas fa-users"></span> Users</button>
   </div>
 </div>

 <div class="col-md-12">
   <div class="d-flex jusify-content-center h-100">
    <button class="btn btn-danger buttoncss btn-block border-secondary"><span class="fas fa-trash"></span> Archive</button>
  </div>
</div>

</div>
  </div>
</div>

 <?php
include './includes/footer.php';
  ?>
<script src="index.js" type="text/javascript"></script>
