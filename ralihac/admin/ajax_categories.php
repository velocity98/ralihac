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

else{
  $output = '';
   while($category = mysqli_fetch_assoc($results)){
     $date = new datetime($category['category_date']);
     $output .= "<tr class='bg-info'>
                   <td><a href='categories.php?edit=". $category['category_id']. "' type='submit' name='edit' class='btn btn-sm btn-light'><i class='fas fa-edit'></i></a>
                       <button id='delete' name='delete' onclick='deleteThis(".$category['category_id'].")' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>
                   </td>
                   <td>". $category['category_name'] ."</td>
                   <td>". date_format($date, 'g:ia \o\n l jS F Y') ."</td>
                 </tr>";
   }
  exit($output) ;
}



?>
