<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ralihac/system/initialize.php';
unset($_SESSION['SBuser']);
header('Location: login.php');
?>
