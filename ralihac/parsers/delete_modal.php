<?php
require_once '../system/initialize.php';
if (isset($_POST['id'])):
$hackId = sanitize($_POST['id']);
ob_start();
?>
<div id='deleteModal' class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class='modal-body'>
        <div class='mb-3'>
          <h5 class='text-danger d-inline'><span class='fas fa-exclamation-circle'></span> Warning!</h5>

        </div>
          <p>
            Are you sure you want to permanently delete this Hack?
          </p>
          <div class='d-inline float-right'>
            <button class='btn btn-info border border-dark' onclick='deleteHack(<?php echo $hackId?>)'>Yes</button>
            <button class='btn btn-outline-danger' data-dismiss="modal">No</button>
          </div>
      </div>
    </div>
  </div>
</div>
<?php
endif;
echo ob_get_clean();
?>
