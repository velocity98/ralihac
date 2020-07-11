<?php
require_once '../system/initialize.php';
$approved = 'approved';
$flag = 0;
$stmt = $db->prepare("SELECT * FROM hack_db WHERE (hack_archive = ? AND hack_status = ?) ORDER BY RAND() LIMIT 1");
$stmt->bind_param('is', $flag, $approved);
$stmt->execute();
$stmtResult = $stmt->get_result();
$row = mysqli_fetch_assoc($stmtResult);
echo $row['hack_id'];
 ?>
