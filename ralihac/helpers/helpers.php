<?php
function login($admin_id){ // admin login
  $_SESSION['SBAdmin'] = $admin_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE admin SET admin_date = '$date' WHERE admin_id = '$admin_id' ");
  header('Location: index.php');
}

function user_login(){
 // complete this
}

function sanitize($wrong){
  return htmlentities($wrong, ENT_QUOTES, "UTF-8");
}

function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    return $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    return $y;
  }
}

function is_logged_in(){
  if(isset($_SESSION['SBAdmin']) && $_SESSION['SBAdmin'] > 0){
    return true;
  }
  return false;
}

function login_redirect($url = 'login.php'){
  header('Location: '.$url);
}
 ?>
