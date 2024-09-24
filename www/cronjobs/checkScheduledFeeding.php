<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the SMS and Email notification files
require_once '/var/www/cronjobs/send_sms.php';
require_once '/var/www/cronjobs/send_email.php';
require_once '/var/www/cronjobs/log.php';


// Log script start
logMessage("Cron job checkScheduledFeeding.php started.");

// Database connection
$conn = new mysqli("localhost", "admin", "123", "db_equasmart");

if ($conn->connect_error) {
    logMessage("Database connection failed: " . $conn->connect_error);
    die("Database connection failed.");
}

logMessage("Database connection established.");

// Get current time and day for scheduled feeding checks
$current_time = date("H:i:s");  // Current time (HH:MM:SS)
$current_day = date('l');       // Current day of the week (e.g., 'Monday')

// Get user details (replace userId with the relevant ID)
$userId = 1;
$sql_user = "SELECT EmailAddress, ContactNumber FROM users WHERE UserID = ? AND is_active = 1 LIMIT 1";
$stmt_user = $conn->prepare($sql_user);
if (!$stmt_user) {
    logMessage("Failed to prepare user query: " . $conn->error);
    die("Query failed.");
}
$stmt_user->bind_param("i", $userId);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user && $result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
    $email = $user['EmailAddress'];
    $phoneNumber = $user['ContactNumber'];
    logMessage("User details retrieved: Email = $email, Phone = $phoneNumber.");
} else {
    logMessage("No active user found for UserID: $userId.");
    die("User not found.");
}

// Fetch scheduled feedings for the current day
$sql_schedule = "SELECT * FROM feeding_schedule WHERE day_of_week = ? AND time <= ? AND feed_duration = 0";
$stmt_schedule = $conn->prepare($sql_schedule);
// Check if the prepare() was successful
if (!$stmt_schedule) {
    logMessage("Failed to prepare schedule query: " . $conn->error);
    die("Query failed.");
}
$stmt_schedule->bind_param("ss", $current_day, $current_time);
$stmt_schedule->execute();
$result_schedule = $stmt_schedule->get_result();

if ($result_schedule && $result_schedule->num_rows > 0) {
    while ($schedule = $result_schedule->fetch_assoc()) {
        $schedule_id = $schedule['id'];
        $feeding_time = $schedule['time'];
        logMessage("Scheduled feeding found: ID = $schedule_id, Time = $feeding_time.");

        // Fetch feed settings to get the amount of feed in grams
        $sql_feed_settings = "SELECT amount_per_feeding FROM feed_settings LIMIT 1";
        $result_feed_settings = $conn->query($sql_feed_settings);

        if ($result_feed_settings && $result_feed_settings->num_rows > 0) {
            $feed_settings = $result_feed_settings->fetch_assoc();
            $grams_to_feed = floatval($feed_settings['amount_per_feeding']);
            logMessage("Amount to feed: $grams_to_feed grams.");

            // Fetch motor calibration (grams per second)
            $sql_motor_calibration = "SELECT grams_per_second FROM feedmotor_calibration ORDER BY calibration_time DESC LIMIT 1";
            $result_motor_calibration = $conn->query($sql_motor_calibration);

            if ($result_motor_calibration && $result_motor_calibration->num_rows > 0) {
                $motor_calibration = $result_motor_calibration->fetch_assoc();
                $grams_per_second = floatval($motor_calibration['grams_per_second']);

                // Calculate the motor runtime (how long the motor should run, in seconds)
                $motor_runtime_seconds = $grams_to_feed / $grams_per_second;

                // Log the motor runtime
                logMessage("Motor will run for $motor_runtime_seconds seconds.");

                // Simulate motor activation
                controlMotor("on");
                sleep($motor_runtime_seconds);
                controlMotor("off");
                logMessage("Motor ran for $motor_runtime_seconds seconds and stopped.");

                // Mark the feeding as completed
                $sql_update_schedule = "UPDATE feeding_schedule SET feed_duration = 1, updated_at = NOW() WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update_schedule);
                if (!$stmt_update) {
                    logMessage("Failed to prepare schedule update: " . $conn->error);
                    die("Update query failed.");
                }
                $stmt_update->bind_param("i", $schedule_id);
                $stmt_update->execute();
                logMessage("Feeding marked as completed for ID: $schedule_id.");

                // Insert data into the feed_history table
                $sql_insert_history = "INSERT INTO feed_history (feed_time, feed_duration, amount, created_at) VALUES (NOW(), ?, ?, NOW())";
                $stmt_insert_history = $conn->prepare($sql_insert_history);
                if (!$stmt_insert_history) {
                    logMessage("Failed to prepare feed history insert: " . $conn->error);
                    die("Insert query failed.");
                }
                $stmt_insert_history->bind_param("di", $motor_runtime_seconds, $grams_to_feed);
                $stmt_insert_history->execute();
                logMessage("Feed history logged with time: $feeding_time, duration: $motor_runtime_seconds, amount: $grams_to_feed grams.");

                // Notify the user via SMS and Email
                $message = "A scheduled feeding occurred at $current_time. The motor ran for $motor_runtime_seconds seconds.";
                $subject = "Scheduled Feeding Alert";

                // Send SMS
                sendSMS($phoneNumber, $message);
                logMessage("SMS sent to $phoneNumber.");
                sendEmail($email, "Scheduled Feeding Alert", $message);
                logMessage("Email sent to $email.");

                // Send Email
                sendEmail($email, $subject, $message);
            } else {
                logMessage("No motor calibration data found.");
            }
        } else {
            logMessage("No feed settings found.");
        }
    }
} else {
    logMessage("No scheduled feeding found.");
}

// Close the database connection
$conn->close();
logMessage("Cron job completed.");
/**
 * Function to control the motor (on or off) by sending requests to the ESP32
 * @param string $action 'on' or 'off' to control the motor
 */
function controlMotor($action) {
    $esp32Ip = "http://esp32feeder.local";  // Replace with the actual IP of your ESP32
    $url = "$esp32Ip/motor/$action";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  // Set a 10-second timeout for the request

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_message = curl_error($ch);
        logError("Failed to send motor control request ($action): $error_message");
    } else {
        // Log the successful motor control request
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 200) {
            logInfo("Motor control request ($action) sent successfully.");
        } else {
            logError("Motor control request ($action) failed with HTTP status $http_code.");
        }
    }
    curl_close($ch);
}

/**
 * Function to log errors to the output file
 * @param string $message Error message to log
 */
function logError($message) {
    $file_path = '/var/www/html/cron_output.txt';
    $file = fopen($file_path, 'a');
    $current_time = date("Y-m-d H:i:s");
    fwrite($file, "[$current_time] ERROR: $message\n");
    fclose($file);
}

/**
 * Function to log info messages to the output file
 * @param string $message Info message to log
 */
function logInfo($message) {
    $file_path = '/var/www/html/cron_output.txt';
    $file = fopen($file_path, 'a');
    $current_time = date("Y-m-d H:i:s");
    fwrite($file, "[$current_time] INFO: $message\n");
    fclose($file);
}
?>
