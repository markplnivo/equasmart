<?php
header('Content-Type: application/json');
include '../logindbase.php';

// Fetch the amount_per_feeding from the database
$query = "SELECT amount_per_feeding FROM feed_settings WHERE id = 1";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $amount_per_feeding = $row['amount_per_feeding'];
    $duration = ceil($amount_per_feeding / 5) * 1000; // Convert to milliseconds
} else {
    echo json_encode(['error' => 'No settings found']);
    exit;
}

$conn->close();

// Define the full path to the Python interpreter and the Python script
$python_path = 'C:\\Users\\Jayson\\PycharmProjects\\pythonProject\\venv\\Scripts\\python.exe';  // Adjust this path to your Python executable
$script_path = 'C:\\Users\\Jayson\\PycharmProjects\\pythonProject\\control_arduino.py';  // Adjust this path to your Python script

// Run the Python script to control the Arduino
$command = escapeshellcmd("\"$python_path\" \"$script_path\" $duration");
$output = shell_exec($command);

// Check if the command was successful
if (strpos($output, 'Error') === false) {
    // Calculate the amount based on the run time
    $amount = ($duration / 1000) * 5; // Amount in whatever units you are measuring

    // Insert data into feed_history table
    include '../logindbase.php'; // Re-establish database connection
    $stmt = $conn->prepare("INSERT INTO feed_history (feed_time, amount, created_at) VALUES (NOW(), ?, NOW())");
    $stmt->bind_param("d", $amount);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Stepper motor activated and feed history updated', 'output' => $output]);
    } else {
        echo json_encode(['error' => 'Stepper motor activated but failed to update feed history']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Failed to activate stepper motor', 'output' => $output]);
}
?>
