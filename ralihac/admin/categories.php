<?php
require_once '../system/initialize.php';
if(!is_logged_in()){
  login_redirect();
}
include './includes/head.php';
include './includes/nav.php';
$category = ((isset($_POST['aesubmit']))?sanitize($_POST['aesubmit']):'');
if (isset($_POST['aesubmit'])){

}
 ?>
<div class="container">
  <!-- Modal Add -->
  <div class="modal fade" id="addmodal">
  <div class="modal-dialog ">
    <div class="modal-content">


      <div class="modal-header">
        <h4 class="modal-title">New Category</h4>
      </div>

      <div class="modal-body">
        <div>
          <input class="form-control" id="categoryText" placeholder="Enter Category Name..."  type="text" />
          <small id="errorcheck1"></small>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger border-dark" data-dismiss="modal">Close</button>
        <input type="button" class="btn btn-success border-dark" id="addCategory" onclick="addCategory()" value="Add">
      </div>

    </div>
  </div>
  </div>




  <br />
  <h2 class="text-light text-center">Categories</h2>
  <br />
  <div class="row">
    <div class="container text-left">
          <button name="add" id="addModal" onclick="modalShow()" class="btn btn-info border-light"><i class="fas fa-plus"></i> Add Category</button>
    </div>

  </div>
  <br />

  <div class="table-responsive">
    <table class="table table-striped table-dark tableborder" id="tabledata">
      <thead>
        <th></th>
        <th>Categories</th>
        <th>Date Modified</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

</div>
 <?php
include './includes/footer.php';
  ?>
  <script type="text/javascript" src="ajax_categories.js"></script>
