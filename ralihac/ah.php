<?php
require_once 'system/initialize.php';
if (is_logged_in_user() == false){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
$categorydb = ("SELECT * FROM category_db ORDER BY category_name");
$categoryquery = $db->query($categorydb);
?>
<div class='modal fade' id='modalImage' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title text-success'><i class='fas fa-check-circle'></i> Success!</h5>
      </div>
      <div class='modal-body'>
        <p>
          Hooray! You have created your very own Life Hack. Now what? Unfortunately your Life Hack must first be verfied by Ralihac before showing it to the world.
        </p>
        <h5>Would you like to Create another one?</h5>
      </div>
      <div class='modal-footer'>
        <button onclick='clearFields()' class='btn btn-info border border-dark text-light' data-dismiss='modal'>Yes</button>
        <a href='pd.php' class='btn btn-light border border-primary text-primary'>No</a>
      </div>
    </div>
  </div>
</div>

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
      <legend>
        Add Hack
      </legend>
      <hr />
      <!-- Adjust from here FORM-->
      <div class='container'>
      <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-5 height">
              <div class="d-flex justify-content-center h-100">
                <div>
                    <div id="image_preview"><img id="previewing" class="img-fluid widget" src="./images/siteimages/no_image.png" /></div>
                    <br />
                        <div id="selectImage">
                          <div class="custom-file" id='customFile'>
                            <label class="text-dark custom-file-label" for="file" id='fileText'>Select Your Image</label>
                            <input type="file" name="file" class="custom-file-input" id="file" />
                          </div>
                          <small id='noImage' class='text-danger'></small>
                          <div id="message"></div>
                        </div>
                </div>
            </div>
          </div>
          <div class="col-md-7 height">
            <div class="justify-content-center h-100">
              <div class="form-group row">
                    <label class="col-form-label col-md-4" for="hack">Hack Title: </label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="hack" id="hack" />
                      <small id='noName' class='text-danger'></small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-form-label col-md-4" for="categories">Hack Category: </label>
                      <div class="col-md-8">
                        <select id="categories" class="form-control" name="categories">
                          <option></option>
                        <?php while($x = mysqli_fetch_assoc($categoryquery)): ?>
                          <option><?php echo $x['category_name']?></option>
                        <?php endwhile; ?>
                        </select>
                        <small id='noNameTwo' class='text-danger'></small>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-form-label col-md-4" for="description">Hack Description: </label>
                      <div class="col-md-8">
                        <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                        <small id='noNameThree' class='text-danger'></small>
                      </div>
                  </div>

                  <div class='text-right'>
                    <input type="submit" value="Upload" class="submit btn btn-info border-dark" />
                    <a href='profile.php' class="btn btn-light border-primary text-primary">Cancel</a>
                  </div>

          </div>
        </div>
      </form>
    </div>
        <!-- Until Adjust here FORM -->
    </div>
  </div>
</div>
</div>
<?php
include 'includes/footer.php';
?>
<script type='text/javascript' src='ah.js'></script>
