<?php
header('Content-Type: application/json');
include '../logindbase.php';

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$result = $conn->query("SELECT amount_per_feeding, feeding_session_frequency, adjust_amount_by FROM feed_settings WHERE id=1");

if ($result->num_rows > 0) {
    $settings = $result->fetch_assoc();
    echo json_encode($settings);
} else {
    echo json_encode(['error' => 'No settings found']);
}

$conn->close();
?>
