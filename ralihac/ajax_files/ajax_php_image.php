<?php
require_once "../system/initialize.php";
require_once '../vendor/autoload.php';
use Google\Cloud\Vision\VisionClient;

if(isset($_FILES["file"]["type"])){
  
$validextensions = array("jpeg", "jpg");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 1200000) && in_array($file_extension, $validextensions)) {
  if ($_FILES["file"]["error"] > 0){
  return print("Return Code: " . $_FILES["file"]["error"] . "<br/><br/>");
  }
  else{
      $sourcePath = $_FILES['file']['tmp_name'];
      $targetPath = "../images/hackimages/".md5(microtime()).$_FILES['file']['name'];
      $targetPath = sanitize($targetPath);
      $hackName = sanitize($_POST['hack']);
      $hackCategory = sanitize($_POST['categories']);
      $hackDescription = sanitize($_POST['description']);
      $date = date("Y-m-d H:i:s");

      $categoryQuery = ("SELECT * FROM category_db WHERE category_name = ? ");
      $stmt = $db->prepare($categoryQuery);
      $stmt->bind_param('s', $hackCategory);
      $stmt->execute();
      $stmtResult = $stmt->get_result();

      // api content date
      $vision = new VisionClient([
        'keyFilePath' => '../project-1d37b8eb2c65.json'
      ]);
      $imageResource = fopen($sourcePath, 'r'); //get image first
      $image = $vision->image($imageResource, [ 'safeSearch' ]);
      $annotation = $vision->annotate($image);

      $safeSearch = $annotation->safeSearch();
      // api content date
     if ($safeSearch->isAdult()){
       return print ('explicit');
     }

      if($stmtResult->num_rows == 0){
        return print ("<small id='error' class='text-danger'>Category doesn't exist</small>"."<br><small id='error_message' class='text-danger'>Select a Valid Category</small>");

      }else{
        $query = ("INSERT INTO hack_db (hack_image, hack_name, hack_category, hack_description, user_id, hack_date) VALUES (?,?,?,?,?,?)");
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssssis', $targetPath, $hackName, $hackCategory, $hackDescription, $user_id, $date);
        $stmt->execute();
        $stmt->close();
        move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file
        return print ('uploaded');
      }
  }
}
else{
return print ("<small id='error' class='text-danger'>Please Select A valid Image File</small>"."<br><small id='error_message' class='text-danger'>Only jpeg and jpg images type allowed</small>");
}
}
?>
