<?php
  require_once '../system/initialize.php';
  $hackdb = ("SELECT * FROM hack_db WHERE hack_archive = '0'");
  $hackquery = $db->query($hackdb);

  if(isset($_POST['delete'])){
    $delete_id = $_POST['delete'];
    $delete_id = sanitize($delete_id);
    $archiveFlag = 1;
    $deletequery =("UPDATE hack_db SET hack_archive = ? WHERE hack_id = ?");
    $stmt = $db->prepare($deletequery);
    $stmt->bind_param('ii', $archiveFlag, $delete_id);
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

    $category_db = ("SELECT * FROM category_db");
    $category_query = $db->query($category_db);

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
                        <span id='hackChange'>".$edit_hack['hack_name']."</span>
                      </div>
                      <div class='card-body'>
                        <p class='card-text' id='descriptionChange'>".$edit_hack['hack_description']."</p>
                      </div>
                  </div>
                </div>

                <div class='col-md-6'>

                <form id='editPost' action='hacks.php' method='post' enctype='multipart/form-data'>
                    <div class='form-group row'>
                      <label class='col-form-label col-md-12' for='hackEdit'>Hack Title: </label>
                      <div class='col-md-12'>
                        <input type='text' class='form-control' name='hackEdit' id='hackEdit' value='".$edit_hack['hack_name']."'/>
                        <small id='noNameEdit'></small>
                      </div>
                    </div>

                    <div class='form-group row'>
                      <label class='col-form-label col-md-12' for='categoriesEdit'>Hack Category: </label>
                        <div class='col-md-12'>
                          <select id='categoriesEdit' class='form-control' name='categories'>";

                          while($x = mysqli_fetch_assoc($category_query)){
                              $outputModal .=  "<option ".(($x['category_name'] == $edit_hack['hack_category']) ? 'selected' : '').">".$x['category_name']."</option>";
                          }

                $outputModal .=  "
                          </select>
                          <small id='noNameTwoEdit'></small>
                        </div>
                    </div>

                    <div class='form-group row'>
                      <label class='col-form-label col-md-12' for='descriptionEdit'>Hack Description: </label>
                        <div class='col-md-12'>
                          <textarea id='descriptionEdit' name='descriptionEdit' class='form-control' rows='5'>".$edit_hack['hack_description']."</textarea>
                          <small id='noNameThreeEdit'></small>
                        </div>
                    </div>

                    </div>

                  </div>
                </div>

                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger border-dark' data-dismiss='modal'>Close</button>
                  <input type='button' class='btn btn-success border-dark' id='editCategory' onclick='editHackModal(".$edit_hack['hack_id'].")' value='Save Changes'>
                </div>

                </form>

          </div>
        </div>
      </div>";

    exit($outputModal);
  }
  if(isset($_POST['editFinal'])){
    $edit_hack_id = $_POST['editFinal'];
    $edit_hack_id = sanitize($edit_hack_id);
    $edit_hackName = $_POST['hackEditName'];
    $edit_hackName = sanitize($edit_hackName);
    $edit_hackCategory = $_POST['hackEditCategory'];
    $edit_hackCategory = sanitize($edit_hackCategory);
    $edit_hackDescription = $_POST['hackEditDescription'];
    $edit_hackDescription = sanitize($edit_hackDescription);
    $edit_hackQuery = ("UPDATE hack_db SET hack_name = ?, hack_category = ?, hack_description = ? WHERE hack_id = ?");
    $stmt = $db->prepare($edit_hackQuery);
    $stmt->bind_param('sssi', $edit_hackName, $edit_hackCategory, $edit_hackDescription, $edit_hack_id);
    $stmt->execute();
    $stmt->close();
  }
  else{
    $output = '';
    while($hacks = mysqli_fetch_assoc($hackquery)){
    $output .=   "<div class='col-md-4'>
                    <div class='card widget card-spacing' id='card-hack'>
                      <img src='".$hacks['hack_image']."' class='card-img-top bg-light' alt='...' style='width: auto; height: 11rem' >
                        <div class='card-header'>
                          <span>".$hacks['hack_name']."</span>
                        </div>
                        <div class='card-body card-body-css' id='card-body' style='display: none'>
                          <p class='card-text'>".custom_echo($hacks['hack_description'], 68, $hacks['hack_id'])."</p>
                        </div>
                        <div class='card-footer' id='noMove'>
                          <button class='btn btn-info border-dark' onClick='editHack(".$hacks['hack_id'].")'>Edit</button>&nbsp<button class='btn btn-light border-info text-info' onClick='deleteHack(".$hacks['hack_id'].")'>Delete</button>
                        </div>
                    </div>
                  </div>
                  ";
    }
    exit($output);
  }
 ?>
