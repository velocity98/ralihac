<?php
require_once 'system/initialize.php';
if (is_logged_in_user() == false){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
include 'includes/successHackModal.php';
include 'includes/explicitModal.php';
include 'includes/loadingModal.php';
$categorydb = ("SELECT * FROM category_db ORDER BY category_name");
$categoryquery = $db->query($categorydb);
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
