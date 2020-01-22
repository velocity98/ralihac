<?php
  require_once '../system/initialize.php';
  if (isset($_POST['hackId'])):
    $hack_id = $_POST['hackId'];
    $query = ("SELECT * FROM hack_db WHERE hack_id = ?");
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $hack_id);
    $stmt->execute();
    $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()):
        ob_start();
?>



<div class="modal" id='hackModal' tabindex="-1" role="dialog">
    <div class='container'>
      <div class='col-12' style="margin-top: 5%;">
        <div class='row align-items-center justify-content-center'>
            <div class='black-container' >
              <div class="d-flex h-100 justify-content-center align-content-center" >
                <img class="" src="<?php echo trim_image_string($row['hack_image'])?>" style="max-height: 500px; max-width: 700px; z-index: 2;">
              </div>
            </div>
            <div >
              <div class="modal-dialog" role="document" style='height: 500px;'>
                <div class="modal-content" style='border-radius: 0 !important; width: 400px;'>
                    <div class="modal-body" style='height: 429px;'>
                      <div>
                        <h4 class='d-inline'><b><?php echo $row['hack_name']?></b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <span class='text-secondary'><?php echo "By: ".$row['hack_user']?></span>
                      <h6 class='text-secondary'><?php echo "Added on ".date_format(date_create($row['hack_date']), "m-d-Y")?></h6>
                      <br />
                      <h5 class='text-info'><?php echo $row['hack_category']." Hack"?></h5>
                      <br />
                        <p>
                          <?php echo $row['hack_description']?>
                        </p>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>

    </div>

</div>

<?php endwhile; ?>
<?php return print ob_get_clean();?>
<?php endif; ?>
