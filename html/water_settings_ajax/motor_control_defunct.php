<?php
// Database connection settings
include "logindbase.php";

// Function to send motor control commands to ESP32
function sendMotorCommand($motor, $direction, $time) {
    $esp32_ip = 'esp32water.local';
    $url = "http://$esp32_ip/control_motor";
    $data = array("motor" => $motor, "direction" => $direction, "time" => $time);
    $json_data = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($json_data)));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// Function to run test sequence in the background
function runTestSequence($testType) {
    global $conn;

    ignore_user_abort(true); // Continue execution even if the user closes the browser
    set_time_limit(0);       // Remove time limit for long-running processes

    $sequence = [];
    if ($testType == "test_ammonia") {
        // Retrieve saved times for Ammonia 1 and Ammonia 2
        $ammonia1_time = getMotorTime($conn, "ammonia1");
        $ammonia2_time = getMotorTime($conn, "ammonia2");

        // Define each step in the sequence
        $sequence = [
            ["motor" => "ammonia1", "direction" => "forward", "time" => $ammonia1_time],
            ["motor" => "ammonia1", "direction" => "reverse", "time" => $ammonia1_time],
            ["delay" => 1000],  // Delay between steps
            ["motor" => "ammonia2", "direction" => "forward", "time" => $ammonia2_time],
            ["motor" => "ammonia2", "direction" => "reverse", "time" => $ammonia2_time],
            ["delay" => 1000],
            ["motor" => "air_pump", "direction" => "forward", "time" => 500],  // Optional air pump step
            ["action" => "capture_image"]  // Take a picture
        ];
    }

    foreach ($sequence as $step) {
        // Execute motor command
        if (isset($step['motor'])) {
            sendMotorCommand($step['motor'], $step['direction'], $step['time']);
        }
        // Execute delay
        elseif (isset($step['delay'])) {
            usleep($step['delay'] * 1000); // Convert milliseconds to microseconds
        }
        // Handle other actions like image capture
        elseif (isset($step['action']) && $step['action'] == "capture_image") {
            // Add code to handle image capture if needed
        }
    }
}

// Helper function to retrieve motor times
function getMotorTime($conn, $motor) {
    $stmt = $conn->prepare("SELECT run_time_ms FROM motor_times WHERE motor_name = ?");
    $stmt->bind_param("s", $motor);
    $stmt->execute();
    $stmt->bind_result($time);
    $stmt->fetch();
    $stmt->close();
    return $time ?? 0;
}

// AJAX request to initiate the test sequence
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['test_type'])) {
    $testType = $_POST['test_type'];
    runTestSequence($testType);  // Run the test sequence in the background
    echo json_encode(["status" => "test_started"]);
    exit;
}

$conn->close();
?>