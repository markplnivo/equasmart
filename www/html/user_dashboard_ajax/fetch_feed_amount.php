<?php
header('Content-Type: application/json');
include '../logindbase.php';

// Get today's date
$today = date('Y-m-d');

// Query to sum up the feed amounts for today
$query = "SELECT SUM(amount) as total_feed FROM feed_history WHERE DATE(feed_time) = '$today'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_feed = $row['total_feed'] ? $row['total_feed'] : 0;
    echo json_encode(['total_feed' => $total_feed]);
} else {
    echo json_encode(['total_feed' => 0]);
}

$conn->close();
?>
