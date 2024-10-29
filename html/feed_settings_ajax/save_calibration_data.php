<?php
header('Content-Type: application/json');
include '../logindbase.php';
// Check if grams_per_second is set via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['grams_per_second'])) {
    $gramsPerSecond = floatval($_POST['grams_per_second']); // Sanitize input

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO feedmotor_calibration (grams_per_second) VALUES (?)");
    $stmt->bind_param("d", $gramsPerSecond);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save calibration data."]);
    }

    $stmt->close();
}

$conn->close();
?>
