<?php
include '../logindbase.php';

$data = json_decode(file_get_contents('php://input'), true);

$index = $data['index'] ?? null;
$scheduleTestType = $data['testType'] ?? ''; // Changed variable name

try {
    $stmt = $db->prepare("SELECT scheduled_time FROM water_testing_schedule WHERE test_type = ?");
    $stmt->execute([$scheduleTestType]); // Use the new variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $times = explode(',', $row['scheduled_time']);
        unset($times[$index - 1]); // Remove the time at the given index
        $updatedTimes = implode(',', $times);

        // Update the database
        $updateStmt = $db->prepare("UPDATE water_testing_schedule SET scheduled_time = ? WHERE test_type = ?");
        $updateStmt->execute([$updatedTimes, $scheduleTestType]);
    }

    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
