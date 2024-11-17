<?php
include '../logindbase.php'; // Ensure this file initializes the $conn variable for mysqli

if (!isset($conn)) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection not established.']));
}

$data = json_decode(file_get_contents('php://input'), true);

$scheduleTestType = $data['testType'] ?? null;
$daysOfWeek = isset($data['daysOfWeek']) ? implode(',', $data['daysOfWeek']) : '';
$testingTimes = isset($data['testingTimes']) ? implode(',', $data['testingTimes']) : '';

if (empty($scheduleTestType)) {
    echo json_encode(['status' => 'error', 'message' => 'Test type is required.']);
    exit;
}

try {
    // Use ON DUPLICATE KEY UPDATE to prevent duplicate rows
    $query = "INSERT INTO water_testing_schedule (test_type, days_of_week, scheduled_time)
              VALUES (?, ?, ?)
              ON DUPLICATE KEY UPDATE days_of_week = VALUES(days_of_week), scheduled_time = VALUES(scheduled_time)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $scheduleTestType, $daysOfWeek, $testingTimes);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Schedule saved successfully.']);
    } else {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

$conn->close();
?>
