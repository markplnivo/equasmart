<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php'
include  __DIR__ . '/config.php';
require_once __DIR__ . '/log.php';
/**
 * Function to send an email using PHPMailer
 * @param string $emailAddress The recipient's email address
 * @param string $subject The subject of the email
 * @param string $message The body of the email
 * @return void
 */
function sendEmail($emailAddress, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;  // Set to 2 for detailed debugging
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_SECURE;  // Use 'tls' or 'ssl'
        $mail->Port = SMTP_PORT;

        // Recipients
        $mail->setFrom('equasmartsupport@portfoliomjp.com', 'eQuaSmart Company');
        $mail->addAddress($emailAddress);

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        logMessage("Email sent successfully to $emailAddress.");
    } catch (Exception $e) {
        logMessage("Failed to send email to $emailAddress. Error: " . $mail->ErrorInfo);


    }
}
?>
