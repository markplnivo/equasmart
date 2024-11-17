<?php
include '../logindbase.php';

$testType = $_GET['testType'] ?? '';

try {
    $stmt = $db->prepare("SELECT scheduled_time FROM water_testing_schedule WHERE test_type = ?");
    $stmt->execute([$testType]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $times = explode(',', $row['scheduled_time']); // Split saved times
        echo json_encode($times);
    } else {
        echo json_encode([]); // No schedules found
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
