<?php
header('Content-Type: application/json');
include '../logindbase.php';

// Decode the JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
}

$feedingTimes = $data['feedingTimes'];
$daysOfWeek = $data['daysOfWeek'];

// Clear existing schedule
$conn->query("DELETE FROM feeding_schedule WHERE id > 0");

foreach ($feedingTimes as $time) {
    foreach ($daysOfWeek as $day) {
        $query = "INSERT INTO feeding_schedule (time, day_of_week, created_at, updated_at) VALUES ('$time', '$day', NOW(), NOW())";
        if (!$conn->query($query)) {
            echo json_encode(['error' => 'Error saving feeding schedule']);
            $conn->close();
            exit;
        }
    }
}

echo json_encode(['success' => 'Feeding schedule saved successfully']);
$conn->close();
?>
