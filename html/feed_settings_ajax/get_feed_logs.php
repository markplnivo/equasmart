<?php
// Database connection
include '../logindbase.php';

// Query to retrieve feed history
// $sql = "SELECT feed_time, amount, notes FROM feed_history WHERE feed_date = ?";
$sql = "SELECT feed_time, amount, motor_runtime FROM feed_history";
$stmt = $conn->prepare($sql);
// $stmt->bind_param('s', $_POST['selectedDate']); // Use selectedDate if filtering by date
$stmt->execute();
$result = $stmt->get_result();

$logs = [];
while ($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

// Send logs as JSON
header('Content-Type: application/json');
echo json_encode($logs);
?>
