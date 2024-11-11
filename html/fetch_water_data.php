<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "", "db_equasmart");

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Query the water_test_input table, ordering by Date_and_Time
$sql = "SELECT Date_and_Time, Name, Value FROM water_test_input ORDER BY Date_and_Time";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit();
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Output the data as JSON
echo json_encode($data);

$conn->close();
?>
