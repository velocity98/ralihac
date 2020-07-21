<?php
require_once '../system/initialize.php';
$flag = 0;
$stmt = $db->prepare("SELECT * FROM hack_db WHERE hack_archive = ? ORDER BY RAND() LIMIT 1");
$stmt->bind_param('i', $flag);
$stmt->execute();
$stmtResult = $stmt->get_result();
$row = mysqli_fetch_assoc($stmtResult);
echo $row['hack_id'];
 ?>
