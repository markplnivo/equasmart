<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Remove database connection, no scheduled feeding found, cron job completed, and cron jobo checkScheduledFeeding.php started.
// Include the SMS and Email notification files
// include "/var/www/cronjobs/send_sms.php";
// include "/var/www/cronjobs/send_email.php";
// include "/var/www/cronjobs/log.php";
// include(__DIR__ . '/send_email.php');
// include(__DIR__ . '/send_sms.php');
include(__DIR__ . '/log.php');
// Log script start
// logMessage("Cron job checkScheduledFeeding.php started.");

// Database connection
$conn = new mysqli("localhost", "admin", "123", "db_equasmart");

if ($conn->connect_error) {
    logMessage("Database connection failed: " . $conn->connect_error);
    die("Database connection failed.");
}

// logMessage("Database connection established.");

// Get current time and day for scheduled feeding checks
$current_time = new DateTime();  // Current time as DateTime object
$current_day = date('l');        // Current day of the week (e.g., 'Monday')

// Define time window constants for the query (1 minute before and after current time)
$time_before = clone $current_time;
$time_after = clone $current_time;
$time_before->modify('-0 seconds');
$time_after->modify('+59 seconds');

// Convert times to string format
$time_before_str = $time_before->format('H:i:s');
$time_after_str = $time_after->format('H:i:s');

// Get user details (replace userId with the relevant ID)
// $userId = 1;
// $sql_user = "SELECT EmailAddress, ContactNumber FROM users WHERE UserID = ? AND is_active = 1 LIMIT 1";
// $stmt_user = $conn->prepare($sql_user);
// if (!$stmt_user) {
//     logMessage("Failed to prepare user query: " . $conn->error);
//     die("Query failed.");
// }
// $stmt_user->bind_param("i", $userId);
// $stmt_user->execute();
// $result_user = $stmt_user->get_result();

// if ($result_user && $result_user->num_rows > 0) {
//     $user = $result_user->fetch_assoc();
//     $email = $user['EmailAddress'];
//     $phoneNumber = $user['ContactNumber'];
//     logMessage("User details retrieved: Email = $email, Phone = $phoneNumber.");
// } else {
//     logMessage("No active user found for UserID: $userId.");
//     die("User not found.");
// }

// Fetch scheduled feedings for the current day and within the time window
$sql_schedule = "SELECT * FROM feeding_schedule WHERE day_of_week = ? AND time BETWEEN ? AND ?";
$stmt_schedule = $conn->prepare($sql_schedule);
if (!$stmt_schedule) {
    logMessage("Failed to prepare schedule query: " . $conn->error);
    die("Query failed.");
}
$stmt_schedule->bind_param("sss", $current_day, $time_before_str, $time_after_str);
$stmt_schedule->execute();
$result_schedule = $stmt_schedule->get_result();

if ($result_schedule && $result_schedule->num_rows > 0) {
    while ($schedule = $result_schedule->fetch_assoc()) {
        $schedule_id = $schedule['id'];
        $feeding_time = $schedule['time'];
        logMessage("Scheduled feeding found: ID = $schedule_id, Time = $feeding_time.");

        // Fetch feed settings to get the amount of feed in grams
        $sql_feed_settings = "SELECT amount_per_feeding, adjust_amount_by FROM feed_settings LIMIT 1";
        $result_feed_settings = $conn->query($sql_feed_settings);

        if ($result_feed_settings && $result_feed_settings->num_rows > 0) {
            $feed_settings = $result_feed_settings->fetch_assoc();
            $grams_to_feed = floatval($feed_settings['amount_per_feeding']);
            $adjust_amount_by = floatval($feed_settings['adjust_amount_by']);
            logMessage("Amount to feed: $grams_to_feed grams. Adjustment value: $adjust_amount_by grams.");

            // Fetch motor calibration (grams per second)
            $sql_motor_calibration = "SELECT grams_per_second FROM feedmotor_calibration ORDER BY calibration_time DESC LIMIT 1";
            $result_motor_calibration = $conn->query($sql_motor_calibration);

            if ($result_motor_calibration && $result_motor_calibration->num_rows > 0) {
                $motor_calibration = $result_motor_calibration->fetch_assoc();
                $grams_per_second = floatval($motor_calibration['grams_per_second']);

                // Calculate the motor runtime (how long the motor should run, in seconds)
                $motor_runtime_seconds = round($grams_to_feed / $grams_per_second, 2);

                // Log the motor runtime
                logMessage("Motor will run for $motor_runtime_seconds seconds.");

                // Simulate motor activation
                controlMotor("on");
                sleep($motor_runtime_seconds);
                controlMotor("off");
                logMessage("Motor ran for $motor_runtime_seconds seconds and stopped.");

                // Insert data into the feed_history table (without using feed_duration)
                $sql_insert_history = "INSERT INTO feed_history (feed_time, motor_runtime, amount, created_at) VALUES (NOW(), ?, ?, NOW())";
                $stmt_insert_history = $conn->prepare($sql_insert_history);
                if (!$stmt_insert_history) {
                    logMessage("Failed to prepare feed history insert: " . $conn->error);
                    die("Insert query failed.");
                }
                $stmt_insert_history->bind_param("di", $motor_runtime_seconds, $grams_to_feed);
                $stmt_insert_history->execute();
                logMessage("Feed history logged with time: $feeding_time, duration: $motor_runtime_seconds, amount: $grams_to_feed grams.");

                // Update the amount_per_feeding in the feed_settings table
                $new_amount_per_feeding = $grams_to_feed + $adjust_amount_by;
                $sql_update_feed_settings = "UPDATE feed_settings SET amount_per_feeding = ? ORDER BY updated_at DESC LIMIT 1";

                $stmt_update_feed_settings = $conn->prepare($sql_update_feed_settings);
                if (!$stmt_update_feed_settings) {
                    logMessage("Failed to prepare feed settings update: " . $conn->error);
                    die("Update query failed.");
                }
                $stmt_update_feed_settings->bind_param("d", $new_amount_per_feeding);
                $stmt_update_feed_settings->execute();
                logMessage("Updated amount_per_feeding to $new_amount_per_feeding grams.");

                // Notify the user via SMS and Email
                $message = "A scheduled feeding occurred at " . $current_time->format('Y-m-d H:i:s') . ". The motor ran for $motor_runtime_seconds seconds.";
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
// logMessage("Cron job completed.");

/**
 * Function to control the motor (on or off) by sending requests to the ESP32
 * @param string $action 'on' or 'off' to control the motor
 */
function controlMotor($action) {
    $esp32Ip = "https://equasmart.local";  // Replace with the actual IP of your ESP32
    $url = "$esp32Ip/feeder/$action";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  // Set a 10-second timeout for the request
    logInfo("Sending motor control request ($action) to $url.");
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
