<?php
require_once '../system/initialize.php';
if(!is_logged_in()){
  login_redirect();
}
include './includes/head.php';
include './includes/nav.php';
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
          <small id="errorcheck1" class='text-danger'></small>
        </div>

      </div>

      <div class="modal-footer">
        <input type="button" class="btn btn-info border-dark" id="addCategory" onclick="addCategory()" value="Add">
        <button type="button" class="btn btn-light border-primary text-primary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
  </div>

  <br />
  <legend>Categories</legend>
  <hr />
  <div class="row">
    <div class='col-md-3'>
      <div class="card widget" style="margin-top: 3rem; margin-bottom: 1rem;">
        <div class="card-header">
          <h5 style='margin: 1px;'>Customization</h5>
        </div>
        <div class="card-body">
          <button onclick='modalShow()' name="add" id="addModal" class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Add Category</button>
        </div>
      </div>
    </div>
    <div class='col-md-9'>
      <div class="table-responsive">
        <table class="table table-borderless" id="tabledata">
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

  </div>
</div>
 <?php
include './includes/footer.php';
  ?>
  <script type="text/javascript" src="ajax_categories.js"></script>
