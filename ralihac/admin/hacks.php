<?php
require_once '../system/initialize.php';
include './includes/head.php';
include './includes/nav.php';
$categorydb = ("SELECT * FROM category_db ORDER BY category_name");
$categoryquery = $db->query($categorydb);
 ?>
<div class="container">
  <br>
  <?php if(isset($_GET['add'])): ?>
    <!--  -->
    <div class="container">
        <h2 class="text-light text-center">Add Hack</h2><br/>
                <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4 height">
                        <div class="d-flex justify-content-center h-100">
                          <div class="wrap1 bg-info">
                            <div class="card-body">
                              <div id="image_preview"><img id="previewing" src="../images/siteimages/no_image.png" style="height:14rem;width:19rem;" /></div>
                              <br />
                                  <div id="selectImage">
                                    <label class="text-light" for="file">Select Your Image</label><br/>
                                    <input type="file" name="file" id="file"/>
                                    <div id="message"></div>
                                  </div>

                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-8 height">
                      <div class="justify-content-center h-100">
                        <div class="wrap2 bg-info" style="width: 100%;">
                          <div class="card-body">

                            <div class="form-group row">
                              <label class="text-light col-form-label col-md-4" for="hack">Hack Title: </label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" name="hack" id="hack" />
                                <small id='noName'></small>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="text-light col-form-label col-md-4" for="categories">Hack Category: </label>
                                <div class="col-md-8">
                                  <select id="categories" class="form-control" name="categories">
                                    <option></option>
                                  <?php while($x = mysqli_fetch_assoc($categoryquery)): ?>
                                    <option><?php echo $x['category_name']?></option>
                                  <?php endwhile; ?>
                                  </select>
                                  <small id='noNameTwo'></small>
                                </div>
                            </div>

                            <div class="form-group row">
                              <label class="text-light col-form-label col-md-4" for="description">Hack Description: </label>
                                <div class="col-md-8">
                                  <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                                  <small id='noNameThree'></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                          <a href="#" class="btn btn-light border-dark" id="preview">Preview</a>
                          <input type="submit" value="Upload" class="submit btn btn-success border-dark" />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            <div id="message"></div>


    </div>
    <!--  -->
  <?php elseif(isset($_GET['edit'])): ?>

  <?php elseif(isset($_GET['delete'])): ?>

  <?php else: ?>
  <h2 class="text-center text-light">Hacks</h2>
  <div class="text-right">
  <a href="hacks.php?add=1" class="btn btn-danger border-light"><i class="fas fa-plus"></i> Add New Hack</a>
  </div>
  <div class="row" id='hackView'>

  </div>
<?php endif; ?>

</div>
 <?php
include './includes/footer.php';
  ?>
<script type="text/javascript" src="hacks.js">
</script>
