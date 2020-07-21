<?php
require_once 'system/initialize.php';
if (is_logged_in_user() == false){
  header('location: index.php');
}
include 'includes/head.php';
include 'includes/nav.php';
?>

<?php
include 'includes/footer.php'
?>
