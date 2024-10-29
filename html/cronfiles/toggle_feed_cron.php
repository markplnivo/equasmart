<?php
include "../session_handler.php";
include "../logindbase.php";
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Retrieve current status
$sql = "SELECT is_enabled FROM cron_status WHERE job_name = 'feeder'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$current_status = $row['is_enabled'];

// Toggle the status
$new_status = $current_status ? 0 : 1;
$sql_update = "UPDATE cron_status SET is_enabled = $new_status WHERE job_name = 'feeder'";
$conn->query($sql_update);

// Return the new status to the client
echo json_encode(['message' => $new_status ? 'Cron job enabled' : 'Cron job disabled']);

$conn->close();
?>
