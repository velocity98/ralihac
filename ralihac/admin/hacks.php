<?php
require_once '../system/initialize.php';
include './includes/head.php';
include './includes/nav.php';
$hackdb = ("SELECT * FROM hack_db WHERE hack_archive = '0'");
$hackquery = $db->query($hackdb);
 ?>
<div class="container">
  <br>
  <?php if(isset($_GET['add'])): ?>
    <div class="main">
    <h1>Add Hack</h1><br/>
    <hr>
      <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
      <div id="image_preview"><img id="previewing" src="noimage.png" /></div>
        <div id="selectImage">
          <label>Select Your Image</label><br/>
          <input type="file" name="file" id="file" required />
          <br>
          <input type="submit" value="Upload" class="submit" />
        </div>
      </form>
    </div>
    <div id="message"></div>
  <?php elseif(isset($_GET['edit'])): ?>

  <?php elseif(isset($_GET['delete'])): ?>

  <?php else: ?>
  <h2 class="text-center text-light">Hacks</h2>
  <div class="text-right">
  <a href="hacks.php?add=1" class="btn btn-danger border-light"><i class="fas fa-plus"></i> Add New Hack</a>
  </div>
  <div class="row">
    <?php while($hacks = mysqli_fetch_assoc($hackquery)):?>
      <div class="col-md-3">
        <div class="card border-primary card-hack bg-info text-light" style="width: 17rem;">
          <img src="..." class="card-img-top bg-light" alt="..." style="height: 14rem">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="hacks.php?edit=" class="btn btn-primary border-dark">Edit</a>&nbsp<a href="hacks.php?delete=" class="btn btn-danger border-dark">Delete</a>
            </div>
        </div>
      </div>
    <?php endwhile; ?>
</div>
<?php endif; ?>

</div>
 <?php
include './includes/footer.php';
  ?>
<script type="text/javascript" src="hacks.js">
</script>
