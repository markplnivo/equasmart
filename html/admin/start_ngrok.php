<?php
// Only allow this script to be called via a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use shell_exec to start the ngrok process
    $outputStart = shell_exec('sudo systemctl start ngrok.service 2>&1');

    // Check if the ngrok service started successfully
    if ($outputStart === null) {
        // Run the upload_ngrok_url.sh script to upload the URL
        $outputUpload = shell_exec('sudo /home/orangepi/scripts/upload_ngrok_url.sh 2>&1');
        
        // Check if the upload script ran successfully
        if ($outputUpload === null) {
            echo json_encode(["status" => "success", "message" => "REMOTE ON"]);
        } else {
            echo json_encode(["status" => "error", "message" => "ngrok started, but URL upload failed: $outputUpload"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to start ngrok service: $outputStart"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
