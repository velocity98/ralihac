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
        $likeQuery = $db->query("SELECT * FROM like_db WHERE hack_id = $hack_id");
        $saveQuery = $db->query("SELECT * FROM save_db WHERE hack_id = $hack_id");
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
                    <div class="modal-body" style='height: 449px;'>
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
                    <button onclick='allLikeButton(<?php echo $row['hack_id']?>)' class='fas fa-thumbs-up
                    <?php
                    $store = false;
                    while ($rowLikes = mysqli_fetch_assoc($likeQuery)) {
                      if($rowLikes['user_id'] == $user_id){
                        $store = true;
                      }
                    }
                    echo ($store == true) ? 'text-primary' : 'text-secondary';
                    ?>
                      like-button mr-auto' id='allLikeButton<?php echo $row['hack_id']?>'> <span id='allLikeCount<?php echo $row['hack_id']?>'><?php echo mysqli_num_rows($likeQuery)?></span></button>
                    <button onclick='allSaveButton(<?php echo $row['hack_id']?>)' class='fas fa-bookmark
                      <?php
                      $storeSaved = false;
                      while ($rowLikes = mysqli_fetch_assoc($saveQuery)) {
                        if($rowLikes['user_id'] == $user_id){
                          $storeSaved = true;
                        }
                      }
                      echo ($storeSaved == true) ? 'text-success' : 'text-secondary';
                       ?>
                      like-button float-right' id='allSaveButton<?php echo $row['hack_id']?>'><span id='allSaveStatus<?php echo $row['hack_id']?>'><?php echo ($storeSaved == true ? ' Saved' : ' Save')?></span></button>
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
