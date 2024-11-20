<?php
include '/var/www/html/logindbase.php'; // Ensure this file initializes the $conn variable for mysqli

if (!isset($conn)) {
    die("Database connection not established.");
}

// Path to the file that stores the test state
$stateFile = '/var/www/html/water_settings_ajax/test_running.lock';

// Function to check if a test is already running
function isTestRunning()
{
    global $stateFile;
    return file_exists($stateFile);
}

// Function to set test as running
function setTestRunning($running)
{
    global $stateFile;
    if ($running) {
        // Create the file to indicate a test is running
        file_put_contents($stateFile, '1');
    } else {
        // Remove the file to indicate no test is running
        if (file_exists($stateFile)) {
            unlink($stateFile);
        }
    }
}

// Get the current day and time
$currentDay = date('l'); // Full day name (e.g., "Monday")
$currentTime = new DateTime(); // Current time as DateTime object

// Define a 1-minute time window (inside the minute)
$timeBefore = clone $currentTime;
$timeAfter = clone $currentTime;
$timeBefore->modify('-0 seconds'); // Start of the minute
$timeAfter->modify('+59 seconds'); // End of the minute

$timeBeforeStr = $timeBefore->format('H:i:s');
$timeAfterStr = $timeAfter->format('H:i:s');

try {
    // Check if a test is already running
    if (isTestRunning()) {
        echo "\nA test is already in progress. Skipping schedule check.";
        exit;
    }

    // Query all schedules from the database
    $query = "SELECT test_type, days_of_week, scheduled_time FROM water_testing_schedule";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Error retrieving schedules: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $testType = $row['test_type'];
        $daysOfWeek = explode(',', $row['days_of_week']);
        $scheduledTimes = explode(',', $row['scheduled_time']);

        // Check if the current day and time match the schedule
        if (in_array($currentDay, $daysOfWeek)) { // Match current day
            foreach ($scheduledTimes as $time) {
                // Check if the time falls within the 1-minute window
                if ($time >= $timeBeforeStr && $time <= $timeAfterStr) {
            // Set test as running
            setTestRunning(true);

            // Execute run_sequence.php as a command-line PHP script
            $cmd = escapeshellcmd("php /var/www/html/run_sequence.php testType=$testType > /dev/null &");
            exec($cmd, $output, $return_var);

            // Log the result of the command (optional)
            file_put_contents('/var/www/html/water_testing_logs.txt', date('Y-m-d H:i:s') . " - Ran $testType with result: $return_var\n", FILE_APPEND);

              // Duration for each test in seconds
    $testDurations = [
        'ammonia' => 30, // 2 minutes
        'nitrate' => 30, // 2.5 minutes
        'ph' => 30,      // 1.67 minutes
        'flush_test_tube' => 30 // 30 seconds
    ];

                    // Simulate or adjust test duration
                    $duration = $testDurations[$testType] ?? 60;
                    sleep($duration);

            // Mark test as complete
            setTestRunning(false);
                }
            }
        }
    }

    // echo "\n Schedule check completed.";
} catch (Exception $e) {
    // Ensure the test running lock file is cleared on error
    setTestRunning(false);
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
