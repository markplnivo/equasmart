<?php
header('Content-Type: application/json');

// Check if the test_running.lock file exists
$isTestRunning = file_exists('test_running.lock');

// Return JSON response
echo json_encode(['isTestRunning' => $isTestRunning]);
?>
