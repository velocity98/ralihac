<?php
require_once '../system/initialize.php';
include './includes/head.php';
include './includes/nav.php';
$sql = "SELECT * FROM category_db ORDER BY category_name"; //for table
$results = $db->query($sql); // results of query
$category = ((isset($_POST['category']))?sanitize($_POST['category']):'');
$date = date("Y-m-d H:i:s");
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
    <form class="form-inline" action="categories.php<?php echo((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
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
        <?php while($category = mysqli_fetch_assoc($results)): ?>
        <tr class="bg-info">
          <td>
            <a href="categories.php?edit=<?php echo $category['category_id']?>" class="btn btn-sm btn-light"><i class="fas fa-edit"></i></a>
            <a href="categories.php?delete=<?php echo $category['category_id']?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
          </td>
          <td><?php echo $category['category_name']?></td>
          <td><?php $date = new datetime($category['category_date']); echo date_format($date, 'g:ia \o\n l jS F Y') ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</div>
 <?php
include './includes/footer.php';
  ?>
