<?php
require_once '../system/initialize.php';
include './includes/head.php';
include './includes/nav.php';

if (isset($_POST['aesubmit'])){
  $addquery = ("INSERT INTO category_db (category_name, category_date) VALUES (?,?)") ;
  $stmt = $db->prepare($addquery);
  $stmt->bind_param('ss', $category, $date);
  $stmt->execute();
  $stmt->close();
}
 ?>
<div class="container">
  <br />
  <h2 class="text-light text-center">Categories</h2>
  <br />
  <div class="row justify-content-center">
    <form class="form-inline" id="form" action="categories.php<?php echo((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
      <div class="form-group">
          <input type="text" class="form-control" name="category" value="<?php echo $category; ?>" />&nbsp<button name="aesubmit" type="submit" class="btn btn-info"><i class="fas fa-plus"></i> Add</button>
      </div>
    </form>
  </div>
  <br />

  <div class="table-responsive">
    <table class="table text-light tableborder">
      <thead class="bg-primary">
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
