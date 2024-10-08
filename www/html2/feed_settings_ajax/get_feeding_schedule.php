<?php
header('Content-Type: application/json');
include '../logindbase.php';

$result = $conn->query("SELECT time, day_of_week FROM feeding_schedule ORDER BY id ASC");

$schedule = [];
while ($row = $result->fetch_assoc()) {
    $time = $row['time'];
    $day = $row['day_of_week'];

    if (!isset($schedule[$time])) {
        $schedule[$time] = ['time' => $time, 'days' => []];
    }
    $schedule[$time]['days'][] = $day;
}

echo json_encode(array_values($schedule));
$conn->close();
?>
