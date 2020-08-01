<?php
  require_once '../system/initialize.php';
  require_once '../vendor/autoload.php';
  use Google\Cloud\Vision\VisionClient;

    if(isset($_POST['hackId'], $_POST['hackName'], $_POST['hackDescrption'], $_POST['hackCategory'])){

      $hackId = sanitize($_POST['hackId']);
      $hackName = sanitize($_POST['hackName']);
      $hackCategory = sanitize($_POST['hackCategory']);
      $hackDescription = sanitize($_POST['hackDescrption']);

      if(empty($_FILES['file']['name'])){ // if empty update hack without picture with no picture

        $query = ("UPDATE hack_db SET hack_name = ?, hack_category = ?, hack_description = ? WHERE hack_id = ?");
          $stmt = $db->prepare($query);
          $stmt->bind_param('sssi', $hackName, $hackCategory, $hackDescription, $hackId);
          $stmt->execute();
          $stmt->close();

        $results = array(
          'name' => $hackName,
          'category' => $hackCategory,
          'description' => nl2br($hackDescription)
          );

        echo (json_encode($results));

    }else{ // update hack with picture

      if(isset($_FILES["file"]["type"])){

        $validextensions = array("jpeg", "jpg");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);

        if ((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 1200000) && in_array($file_extension, $validextensions)) {

          if ($_FILES["file"]["error"] > 0){

            return print("Return Code: " . $_FILES["file"]["error"] . "<br/><br/>");

          }else{

              $sourcePath = $_FILES['file']['tmp_name'];
              $targetPath = "../images/hackimages/".md5(microtime()).$_FILES['file']['name'];


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

                // get hack_image at db to remove file

                $imageQuery = ("SELECT hack_image FROM hack_db WHERE hack_id = ?");
                $stmt = $db->prepare($imageQuery);
                $stmt->bind_param('i', $hackId);
                $stmt->execute();
                $stmtResult = $stmt->get_result();
                $row = mysqli_fetch_assoc($stmtResult);
                $imagePath = $row['hack_image'];
                unlink($imagePath);

                // update database

                $query = ("UPDATE hack_db SET hack_image = ? , hack_name = ? , hack_category = ?, hack_description = ? WHERE hack_id = ?");
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssssi', $targetPath, $hackName, $hackCategory, $hackDescription, $hackId);
                $stmt->execute();
                $stmt->close();
                move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file



                $results = array(
                  'name' => $hackName,
                  'category' => $hackCategory,
                  'description' => nl2br($hackDescription),
                  'image' => trim_image_string($targetPath) // one dot for directory
                  );

                echo (json_encode($results));

              }

          }

        }else{

          return print ("<small id='error' class='text-danger'>Please Select A valid Image File</small>"."<br><small id='error_message' class='text-danger'>Only jpeg and jpg images type allowed</small>");

        }

      }

      }

    }else{

      header('Location: ../index.php');
      exit;

    }
?>
