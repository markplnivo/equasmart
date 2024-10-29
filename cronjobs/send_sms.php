<?php
require_once __DIR__ . '/config.php';
require_once '/var/www/cronjobs/log.php';


function sendSMS($phoneNumber, $message) {
    $postData = array(
        'apikey' => SEMAPHORE_API,
        'number' => $phoneNumber,
        'message' => $message,
        'sendername' => 'SEMAPHORE'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    if ($output === FALSE) {
        logMessage("SMS sending failed: " . curl_error($ch));
    } else {
        $response = json_decode($output, true);
        if (isset($response['error'])) {
            logMessage("Error sending SMS: " . $response['message']);
        } else {
            logMessage("SMS sent successfully to $phoneNumber.");
        }
    }

    curl_close($ch);
}
?>
