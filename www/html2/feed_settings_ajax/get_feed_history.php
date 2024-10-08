<?php
// Database connection settings
header('Content-Type: application/json');
include '../logindbase.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedDate'])) {
    // Connect to the database

    $selectedDate = $_POST['selectedDate'];

    // Query to fetch feed history for the selected day
    $sql = "SELECT feed_time, amount FROM feed_history WHERE DATE(feed_time) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();

    $feedData = [];
    while ($row = $result->fetch_assoc()) {
        $feedData[] = $row;
    }

    // Return the feed data as JSON
    echo json_encode($feedData);

    $stmt->close();
    $conn->close();
}
?>
