<?php
// motor_control.php

// Check if a testType is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['testType'])) {
    $testType = $_POST['testType'];

    // Determine which test sequence to run based on the testType
    $cmd = '';

    if ($testType === "ammonia") {
        // Run ammonia test sequence
        $cmd = "php ./run_sequence.php testType=ammonia > /dev/null &";
    } elseif ($testType === "nitrate") {
        // Run nitrate test sequence
        $cmd = "php ./run_sequence.php testType=nitrate > /dev/null &";
    } elseif ($testType === "ph") {
        // Run pH test sequence
        $cmd = "php ./run_sequence.php testType=ph > /dev/null &";
    } else {
        // Invalid test type
        echo json_encode(["status" => "error", "message" => "Invalid test type"]);
        exit;
    }

    // Execute the command in the background
    exec($cmd);

    // Respond with a success message
    echo json_encode(["status" => "test_started", "testType" => $testType]);
    exit;
} else {
    echo json_encode(["status" => "error", "message" => "No test type provided_motor_control"]);
    exit;
}
?>
