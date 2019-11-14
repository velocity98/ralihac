<?php
require_once "../system/initialize.php";
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 100000) && in_array($file_extension, $validextensions)) {
  if ($_FILES["file"]["error"] > 0){
  echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
  }
  else{
      $sourcePath = $_FILES['file']['tmp_name'];
      $targetPath = "../images/hackimages/".md5(microtime()).$_FILES['file']['name'];
      $targetPath = sanitize($targetPath);
      var_dump($_POST);
      $hackName = $_POST['hack'];
      $hackCategory = $_POST['categories'];
      $hackDescription = $_POST['description'];
      $ralihac = 'Ralihac';
      $date = date("Y-m-d H:i:s");

      $query = "INSERT INTO hack_db (hack_image, hack_name, hack_category, hack_description, hack_user, hack_date) VALUES (?,?,?,?,?,?)"; //fix ADD
      $stmt = $db->prepare($query);
      $stmt->bind_param('ssssss', $targetPath, $hackName, $hackCategory, $hackDescription, $ralihac, $date);
      $stmt->execute();
      $stmt->close();
      move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
  }
}
else
{
echo "<span id='invalid' class='text-danger'>*Insert valid photo*<span>";
}
}
?>
