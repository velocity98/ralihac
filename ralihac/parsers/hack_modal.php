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
    <div class='container-fluid'>
      <div class='d-inline justify-content-center'>
        <div class='col-12'>
          <div class='h-100 row no-gutters align-items-center'>

              <div class='black-container'>

              </div>
              <div>
                <div class="modal-dialog" role="document" style='height: 500px;'>
                  <div class="modal-content" style='border-radius: 0 !important;'>
                      <div class="modal-body" style='height: 427px;'>
                        <p>Modal body text goes here.</p>
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
  </div>

<?php endwhile; ?>
<?php return print ob_get_clean();?>
<?php endif; ?>
