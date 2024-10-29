<?php
// Define a function to log messages to a log file
function logMessage($message) {
    $logFile = '/var/www/cronjobs/cron_error_log.txt';  // Specify the log file path

    // Include a timestamp with each message
    $timestamp = date("Y-m-d H:i:s");
    $formattedMessage = "[$timestamp] $message\n";

    // Append the message to the log file
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);
}
