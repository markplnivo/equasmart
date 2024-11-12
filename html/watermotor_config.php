<?php ob_start(); ?>
<?php
// Database connection settings
include "logindbase.php";

// Retrieve saved times from the database
$savedTimes = [];
$response = "";

if ($conn) { // Check if the connection was successful
    $result = $conn->query("SELECT motor_name, run_time_ms FROM motor_times");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $savedTimes[$row['motor_name']] = $row['run_time_ms'];
        }
    } else {
        $response = "Error fetching saved times: " . $conn->error;
    }
} else {
    $response = "Database connection failed.";
}

// Handle form submissions to save new times
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $motor = $_POST['motor'] ?? '';
    $time = intval($_POST['time'] ?? 0);

    if ($motor && $time > 0) {
        // Insert or update motor time in database
        $stmt = $conn->prepare("INSERT INTO motor_times (motor_name, run_time_ms) VALUES (?, ?) ON DUPLICATE KEY UPDATE run_time_ms = ?");
        if ($stmt) {
            $stmt->bind_param("sii", $motor, $time, $time);
            if ($stmt->execute()) {
                $response = "Time saved for $motor.";
            } else {
                $response = "Error saving time: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response = "Failed to prepare statement: " . $conn->error;
        }
    } else {
        $response = "Invalid input parameters.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Motor Configuration</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .motor-control { border: 1px solid #ccc; padding: 20px; margin: 20px; }
        .motor-control h2 { text-transform: capitalize; }
        .response { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Motor Configuration</h1>
    <?php if ($response): ?>
        <p class="<?php echo strpos($response, 'Error') !== false ? 'error' : 'response'; ?>">
            <?php echo htmlspecialchars($response); ?>
        </p>
    <?php endif; ?>

    <?php
    // Define motor labels and names
    $motors = array(
        "Ammonia 1" => "ammonia1",
        "Ammonia 2" => "ammonia2",
        "Nitrate 1" => "nitrate1",
        "Nitrate 2" => "nitrate2",
        "pH" => "ph",
        "Control Water" => "control_water",
        "Pond Water" => "pond_water"
    );

    // Display form for each motor to input and save times
    foreach ($motors as $label => $motor) {
        $savedTime = $savedTimes[$motor] ?? '';
        ?>
        <div class="motor-control">
            <h2><?php echo htmlspecialchars($label); ?> Motor</h2>
            <form method="POST" action="">
                <input type="hidden" name="motor" value="<?php echo htmlspecialchars($motor); ?>">
                <label for="<?php echo htmlspecialchars($motor); ?>_time">Run Time (ms):</label>
                <input type="number" id="<?php echo htmlspecialchars($motor); ?>_time" name="time" value="<?php echo htmlspecialchars($savedTime); ?>" min="1" required>
                <br><br>
                <button type="submit">Save Time</button>
            </form>
        </div>
        <?php
    }
    ?>
</body>
</html>
<?php ob_end_flush(); ?>
