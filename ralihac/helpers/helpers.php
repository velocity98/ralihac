<?php
function login($admin_id){ // admin login
  $_SESSION['SBAdmin'] = $admin_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $query = ("UPDATE admin SET admin_date = ? WHERE admin_id = ? ");
  $stmt = $db->prepare($query);
  $stmt->bind_param('ss', $date, $admin_id);
  $stmt->execute();
  header('Location: index.php');
}

function user_login($user_id){
  $_SESSION['SBuser'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE user_db SET user_lastlogin = $date WHERE user_id = $user_id ");
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
