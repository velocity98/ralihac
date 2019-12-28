<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = null;
$dbname = "hackbase";
$db = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
if(mysqli_connect_errno())
{
echo 'Database connection failed with following errors:  '. mysqli_connect_error();
die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/ralihac/config.php';
require_once BASEURL.'/helpers/helpers.php';
if(isset($_SESSION['SBAdmin'])){
  $admin_id = $_SESSION['SBAdmin'];
}
if(isset($_SESSION['SBuser'])){
  $user_id = $_SESSION['SBuser'];
  $userQuery = ("SELECT * FROM user_db WHERE user_id = ?");
  $stmt = $db->prepare($userQuery);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $result =  $stmt->get_result();
  $row = $result->fetch_assoc();
  $username = $row['user_username'];
  $stmt->close();
}
