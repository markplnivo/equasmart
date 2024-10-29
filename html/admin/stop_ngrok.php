<?php
// Only allow this script to be called via a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use shell_exec to stop the ngrok process
    $output = shell_exec('sudo systemctl stop ngrok.service 2>&1');

    if ($output === null) {
        echo json_encode(["status" => "success", "message" => "REMOTE OFF"]);
    } else {
        echo json_encode(["status" => "error", "message" => $output]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
