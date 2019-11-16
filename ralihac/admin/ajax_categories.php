<?php
require_once '../system/initialize.php';
$sql = "SELECT * FROM category_db ORDER BY category_name"; //for table
$results = $db->query($sql); // results of query
$date = date("Y-m-d H:i:s");

  if(isset($_POST['delete'])){
    $delete_id = $_POST['delete'];
    $delete_id = sanitize($delete_id);
    $deletequery ="DELETE FROM category_db WHERE category_id = ? ";
    $stmt = $db->prepare($deletequery);
    $stmt->bind_param('i', $delete_id);
    $stmt->execute();
    $stmt->close();
  }


  if(isset($_POST['newcategory'])){
    $add_name = $_POST['newcategory'];
    $add_name = sanitize($add_name);
    $addquery = ("INSERT INTO category_db (category_name, category_date) VALUES (?,?)") ;
    $stmt = $db->prepare($addquery);
    $stmt->bind_param('ss', $add_name, $date);
    $stmt->execute();
    $stmt->close();
  }

  if(isset($_POST['edit'])){
    $category_id = $_POST['edit'];
    $category_id = sanitize($category_id);
    $categoryquery = ("SELECT * FROM category_db WHERE category_id = ? ");
    $stmt = $db->prepare($categoryquery);
    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $result = $stmt->get_result(); // to object
    $category = $result->fetch_assoc(); // associative array

    $editOutput = "
    <div class='modal fade' id='editmodal'>
      <div class='modal-dialog'>
        <div class='modal-content'>

          <div class='modal-header'>
            <h4 class='modal-title'>Edit Category</h4>
          </div>

          <div class='modal-body'>
            <div>
              <input class='form-control' id='categoryTextEdit' value='".$category['category_name']."' placeholder='Enter Category Name...'  type='text' />
              <small id='errorcheck2'></small>
            </div>
          </div>

          <div class='modal-footer'>
            <button type='button' class='btn btn-danger border-dark' data-dismiss='modal'>Close</button>
            <input type='button' class='btn btn-success border-dark' id='editCategory' onclick='editCategory(".$category['category_id'].")' value='Save Changes'>
          </div>

        </div>
      </div>
    </div>";
    $stmt->close();
    exit($editOutput);
  }
  if(isset($_POST['edit2'])){
    $edit_id = $_POST['edit2'];
    $edit_id = sanitize($edit_id);
    $edit_name = $_POST['names']; //potential problem
    $edit_name = sanitize($edit_name);
    $editquery = ("UPDATE category_db SET category_name = ? WHERE category_id = ?") ;
    $stmt = $db->prepare($editquery);
    $stmt->bind_param('si', $edit_name, $edit_id);
    $stmt->execute();
    $stmt->close();
    exit('success');
  }
else{
  $output = '';
   while($category = mysqli_fetch_assoc($results)){
     $date = new datetime($category['category_date']);
     $output .= "<tr class='bg-info'>
                   <td>
                   <div class='text-nowrap'>
                   <button id='edit' name='edit' onclick='editModal(".$category['category_id'].")' class='btn btn-sm btn-light'><i class='fas fa-edit'></i></button>
                   <button id='delete' name='delete' onclick='deleteThis(".$category['category_id'].")' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                   </div>

                   </td>
                   <td>". $category['category_name'] ."</td>
                   <td>". date_format($date, 'g:ia \o\n l jS F Y') ."</td>
                 </tr>";
   }
  exit($output) ;
}



?>
