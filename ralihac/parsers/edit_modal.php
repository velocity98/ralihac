<?php
require_once '../system/initialize.php';
if (isset($_POST['id'])):
$hackId = sanitize($_POST['id']);

$query = ("SELECT * FROM hack_db WHERE hack_id = ?");
$stmt = $db->prepare($query);
$stmt->bind_param('i', $hackId);
$stmt->execute();
$stmtResult = $stmt->get_result();
$row = mysqli_fetch_assoc($stmtResult);

ob_start();
?>
<div id='editModal' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class='modal-body'>
        <div class='mb-3'>
          <h5 class='text-info d-inline'><span class='fas fa-edit'></span> Edit Life Hack</h5>
        </div>
        <form method="post" action="" onsubmit="return editHack()" id="submitForm" name="editForm">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Hack Name:</label>
          <input type="text" value='<?php echo $row['hack_name']?>' class="form-control" id="hackName" placeholder="Enter Life Hack Name"/ name='hackName'>
          <small id="hackNameError" class="form-text val_error text-danger w-100"></small>
        </div>
        <div class='form-group'>
          <label for'category' class='col-form-label'>Category:</label>
            <select class="form-control" id='hackCategory' name='hackCategory'>

            </select>
          <small id="hackCategoryError" class="form-text val_error text-danger w-100"></small>
        </div>
        <div class="form-group">
          <label for="description" class="col-form-label">Description:</label>
          <textarea class="form-control" id='hackDescrption' placeholder='Enter Life Hack Description' rows="6" name='hackDescrption'><?php echo $row['hack_description']?></textarea>
          <small id="hackDescrptionError" class="form-text val_error text-danger w-100"></small>
        </div>
        <div class='d-inline float-right'>
          <button type='submit' class='btn btn-info border border-dark'><i class='fas fa-check-circle'></i> Save</button>
          <button class='btn btn-outline-danger' data-dismiss="modal">Cancel</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

<?php
$stmt->close();
endif;
echo ob_get_clean();
?>
