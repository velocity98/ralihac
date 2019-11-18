<?php
  require_once '../system/initialize.php';
  $hackdb = ("SELECT * FROM hack_db WHERE hack_archive = '0'");
  $hackquery = $db->query($hackdb);

  if(isset($_POST['delete'])){
    $delete_id = $_POST['delete'];
    $delete_id = sanitize($delete_id);
    $deletequery ="DELETE FROM hack_db WHERE hack_id = ? ";
    $stmt = $db->prepare($deletequery);
    $stmt->bind_param('i', $delete_id);
    $stmt->execute();
    $stmt->close();
  }
  if(isset($_POST['edit'])){
    $edit_id = sanitize($_POST['edit']);
    $edit_query = ("SELECT * FROM hack_db WHERE hack_id = ?");
    $stmt = $db->prepare($edit_query);
    $stmt->bind_param('i', $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_hack = $result->fetch_assoc();

    $outputModal = '';
    $outputModal .=
      "<div class='modal fade modal' id='editModal'>
        <div class='modal-dialog mw-100 w-50'>
          <div class='modal-content'>

            <div class='modal-header'>
              <h5>Edit Category</h5>
            </div>

            <div class='modal-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='card bg-secondary text-light' style='width: 17rem; opacity: 1;'>
                    <img src='".$edit_hack['hack_image']."' class='card-img-top bg-light' alt='...' style='height: 14rem' >
                      <div class='card-header bg-secondary' style='height:;'>
                        <span>".$edit_hack['hack_name']."</span>
                      </div>
                      <div class='card-body'>
                        <p class='card-text'>".$edit_hack['hack_description']."</p>
                      </div>
                  </div>
                </div>

                <div class='col-md-6'>

                    <div class='form-group row'>
                      <label class='col-form-label col-md-12' for='hackEdit'>Hack Title: </label>
                      <div class='col-md-12'>
                        <input type='text' class='form-control' name='hackEdit' id='hackEdit' />
                        <small id='noNameEdit'></small>
                      </div>
                    </div>

                    <div class='form-group row'>
                      <label class='col-form-label col-md-12' for='categoriesEdit'>Hack Category: </label>
                        <div class='col-md-12'>
                          <select id='categoriesEdit' class='form-control' name='categories'>
                            <option></option>
                          </select>
                          <small id='noNameTwoEdit'></small>
                        </div>
                    </div>

                    <div class='form-group row'>
                      <label class='col-form-label col-md-12' for='descriptionEdit'>Hack Description: </label>
                        <div class='col-md-12'>
                          <textarea id='descriptionEdit' name='descriptionEdit' class='form-control' rows='5'></textarea>
                          <small id='noNameThreeEdit'></small>
                        </div>
                    </div>

                </div>

              </div>
            </div>

            <div class='modal-footer'>

            </div>

          </div>
        </div>
      </div>";
    $stmt->close();
    exit($outputModal);
  }
  else{
    $output = '';
    while($hacks = mysqli_fetch_assoc($hackquery)){
    $output .=   "<div class='col-md-3'>
                    <div class='card card-hack bg-secondary text-light border-light' style='width: 17rem;' id='card-hack'>
                      <img src='".$hacks['hack_image']."' class='card-img-top bg-light' alt='...' style='height: 14rem' >
                        <div class='card-header bg-secondary' style='height:;'>
                          <span>".$hacks['hack_name']."</span>
                        </div>
                        <div class='card-body card-body-css' id='card-body' style='display: none'>
                          <p class='card-text'>".custom_echo($hacks['hack_description'], 100)."</p>
                        </div>
                        <div class='card-footer' id='noMove'>
                          <button class='btn btn-primary border-light' onClick='editHack(".$hacks['hack_id'].")'>Edit</button>&nbsp<button class='btn btn-light border-info text-info' onClick='deleteHack(".$hacks['hack_id'].")'>Delete</button>
                        </div>
                    </div>
                  </div>";
    }
    exit($output);
  }
 ?>
