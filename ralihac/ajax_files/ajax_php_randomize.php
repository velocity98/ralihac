<?php
require_once '../system/initialize.php';
$stmt = $db->prepare("SELECT * FROM hack_db ORDER BY RAND() LIMIT 1");
$stmt->execute();
$stmtResult = $stmt->get_result();
$row = mysqli_fetch_assoc($stmtResult);
echo $row['hack_id'];
 ?>
