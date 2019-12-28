<?php
require_once '../system/initialize.php';
if(!is_logged_in()){
  login_redirect();
}
include './includes/head.php';
include './includes/nav.php';
$categorydb = ("SELECT * FROM category_db ORDER BY category_name");
$categoryquery = $db->query($categorydb);
 ?>
<div class="container">
  <br>
  <?php if(isset($_GET['add'])): ?>
    <div class="container">
        <legend>Add Hack</legend>
        <hr />
                <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4 height">
                        <div class="d-flex justify-content-center h-100">
                          <div>
                              <div id="image_preview"><img id="previewing" class="img-fluid widget" src="../images/siteimages/no_image.png" /></div>
                              <br />
                                  <div id="selectImage">
                                    <div class="custom-file">
                                      <label class="text-dark custom-file-label" for="file">Select Your Image</label>
                                      <input type="file" name="file" class="custom-file-input" id="file" />
                                    </div>
                                    <div id="message"></div>
                                  </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-8 height">
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
                              <a href='./hacks.php' class="btn btn-light border-primary text-primary">Cancel</a>
                            </div>
                    </div>
                  </div>
                </form>
    </div>
  <?php else: ?>

    <div class='row row-margin'>
      <div class='col-md-3'>
        <div class="card widget" style="margin-top: 3rem; margin-bottom: 1rem;">
          <div class="card-header">
            <h5 style='margin: 1px;'>Customization</h5>
          </div>
          <div class="card-body">
            <span>Try Ralihac's Randomize &nbsp</span><a class="fas fa-info-circle text-info"></a>
            <a href='hacks.php?add=1' class="btn btn-block border border-dark bg-info text-light" style="margin-top: .5rem">Add New Hack</a>
          </div>
        </div>
      </div>

      <div class='col-md-9'>
        <legend>
          Hacks
        </legend>
        <hr />
        <div class="row" id='hackView'>
        </div>
      </div>
    </div>

<?php endif; ?>

</div>
</div>
 <?php
include './includes/footer.php';
  ?>
<script type="text/javascript" src="hacks.js">
</script>
