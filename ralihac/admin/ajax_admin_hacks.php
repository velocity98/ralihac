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
  else{
    $output = '';
    while($hacks = mysqli_fetch_assoc($hackquery)){
    $output .=   "<div class='col-md-3'>
                    <div class='card border-primary card-hack bg-info text-light' style='width: 17rem;' id='card-hack'>
                      <img src='".$hacks['hack_image']."' class='card-img-top bg-light' alt='...' style='height: 14rem'>
                        <div class='card-header bg-danger' style='height:;'>
                          <span>".$hacks['hack_name']."</span>
                        </div>
                        <div class='card-body card-body-css' id='card-body' style='display: none'>
                          <p class='card-text'>".custom_echo($hacks['hack_description'], 109)."</p>
                        </div>
                        <div class='card-footer'>
                          <button class='btn btn-primary border-dark' onClick='editHack(".$hacks['hack_id'].")'>Edit</button>&nbsp<button class='btn btn-danger border-dark' onClick='deleteHack(".$hacks['hack_id'].")'>Delete</button>
                        </div>
                    </div>
                  </div>";
    }
    exit($output);
  }
 ?>
