<?php
include '../logindbase.php'; // Ensure this file initializes the $conn variable for mysqli

if (!isset($conn)) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection not established.']));
}

$testType = $_GET['testType'] ?? '';

if (empty($testType)) {
    echo json_encode(['status' => 'error', 'message' => 'Test type is required.']);
    exit;
}

try {
    $query = "SELECT days_of_week, scheduled_time FROM water_testing_schedule WHERE test_type = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $testType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'daysOfWeek' => explode(',', $data['days_of_week'] ?? ''),
            'testingTimes' => explode(',', $data['scheduled_time'] ?? '')
        ]);
    } else {
        echo json_encode(['status' => 'success', 'daysOfWeek' => [], 'testingTimes' => []]);
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

$conn->close();
?>
