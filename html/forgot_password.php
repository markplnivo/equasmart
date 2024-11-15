<?php ob_start(); ?>
<?php
include 'logindbase.php';
include 'configCredentials.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

if (isset($_POST['resetSubmit'])) {
    $email = $_POST['email'];
    // Check if the email exists in the database
    $sql = "SELECT EmailAddress FROM users WHERE EmailAddress = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Email exists, proceed with token generation
        $token = bin2hex(random_bytes(32));  // Generate a secure random token
        $sql = "UPDATE users SET reset_token= ? WHERE EmailAddress = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();
        $stmt->close();

        // Setup and send the email
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = SMTP_HOST; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = SMTP_USERNAME;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = SMTP_SECURE; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = SMTP_PORT; // TCP port to connect to

            $mail->setFrom('equasmartsupport@portfoliomjp.com', 'eQuaSmart Company');
            $mail->addAddress($email);

            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Reset Password';
            $resetLink = "equasmart.local/reset_password.php?token=" . $token;
            $mail->Body = 'Please click on the following link to reset your password: <a href="' . $resetLink . '">Reset Password</a>';

            $mail->send();
            echo '<script>
            if (confirm("Password reset instructions have been sent to your email. Click OK to continue.")) {
                window.location.href = "login_page.php";
            } else {
                // User clicked Cancel
            }
            </script>';

        } catch (Exception $e) {
            echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '");</script>';
        }
    } else {
        echo '<script>alert("No account found with that email address.");</script>';
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
    <link rel="stylesheet" href="css/css/all.min.css">
    <link rel="stylesheet" href="css/css/fontawesome.min.css">
    <title>Forgot Password</title>
    <style>
    :root {
    /* FLUID RESPONSIVE PADDING/MARGIN SPACE BASE VALUE = 12px, MIN WIDTH = 320px, AND MAX VALUE = 21px, MAX WIDTH = 1240px (added by mark romualdo)*/
        --space-3xs: clamp(3px, 2.3043px + 0.2174cqi, 5px);/*Multiplier = 0.25*/
        --space-2xs: clamp(6px, 4.2609px + 0.5435cqi, 11px);/*Multiplier = 0.5*/
        --space-xs: clamp(9px, 6.5652px + 0.7609cqi, 16px);/*Multiplier = 0.75*/
        --space-s: clamp(12px, 8.8696px + 0.9783cqi, 21px);/*Multiplier = 1*/
        --space-m: clamp(13px, 9.5217px + 1.087cqi, 23px);/*Multiplier = 1.1*/
        --space-l: clamp(14px, 10.1739px + 1.1957cqi, 25px);/*Multiplier = 1.2*/
        --space-xl: clamp(16px, 12.1739px + 1.1957cqi, 27px);/*Multiplier = 1.3*/
        --space-2xl: clamp(17px, 12.8261px + 1.3043cqi, 29px);/*Multiplier = 1.4*/
        --space-3xl: clamp(18px, 13.1304px + 1.5217cqi, 32px);/*Multiplier = 1.5*/
        --space-4xl: clamp(19px, 13.7826px + 1.6304cqi, 34px);/*Multiplier = 1.6*/
        --space-5xl: clamp(24px, 17.7391px + 1.9565cqi, 42px);/*Multiplier = 2*/
        --space-6xl: clamp(30px, 22px + 2.5cqi, 53px);/*Multiplier = 2.5*/
        --space-7xl: clamp(36px, 26.6087px + 2.9348cqi, 63px);/*Multiplier = 3*/
        --space-8xl: clamp(42px, 30.8696px + 3.4783cqi, 74px);/*Multiplier = 3.5*/
        --space-9xl: clamp(48px, 35.4783px + 3.913cqi, 84px);/*Multiplier = 4*/
        --space-10xl: clamp(54px, 39.7391px + 4.4565cqi, 95px);/*Multiplier = 4.5*/
        --space-11xl: clamp(60px, 44.3478px + 4.8913cqi, 105px);/*Multiplier = 5*/
        --space-12xl: clamp(66px, 48.6087px + 5.4348cqi, 116px);/*Multiplier = 5.5*/
        --space-13xl: clamp(72px, 53.2174px + 5.8696cqi, 126px);/*Multiplier = 6*/

        /* One-up pairs */
        --space-3xs-2xs: clamp(3px, 0.2174px + 0.8696cqi, 11px);
        --space-2xs-xs: clamp(6px, 2.5217px + 1.087cqi, 16px);
        --space-xs-s: clamp(9px, 4.8261px + 1.3043cqi, 21px);
        --space-s-m: clamp(12px, 8.1739px + 1.1957cqi, 23px);
        --space-m-l: clamp(13px, 8.8261px + 1.3043cqi, 25px);
        --space-l-xl: clamp(14px, 9.4783px + 1.413cqi, 27px);
        --space-xl-2xl: clamp(16px, 11.4783px + 1.413cqi, 29px);
        --space-2xl-3xl: clamp(17px, 11.7826px + 1.6304cqi, 32px);
        --space-3xl-4xl: clamp(18px, 12.4348px + 1.7391cqi, 34px);
        --space-4xl-5xl: clamp(19px, 11px + 2.5cqi, 42px);
        --space-5xl-6xl: clamp(24px, 13.913px + 3.1522cqi, 53px);
        --space-6xl-7xl: clamp(30px, 18.5217px + 3.587cqi, 63px);
        --space-7xl-8xl: clamp(36px, 22.7826px + 4.1304cqi, 74px);
        --space-8xl-9xl: clamp(42px, 27.3913px + 4.5652cqi, 84px);
        --space-9xl-10xl: clamp(48px, 31.6522px + 5.1087cqi, 95px);
        --space-10xl-11xl: clamp(54px, 36.2609px + 5.5435cqi, 105px);
        --space-11xl-12xl: clamp(60px, 40.5217px + 6.087cqi, 116px);
        --space-12xl-13xl: clamp(66px, 45.1304px + 6.5217cqi, 126px);

        /* Custom pairs */
        --space-s-l: clamp(12px, 7.4783px + 1.413cqi, 25px);

        /* FLUID RESPONSIVE FONT SIZE BASE VALUE = 9px MIN WIDTH = 425px AND MAX VALUE = 14px MAX WIDTH = 1480px*/
        --step--6: clamp(0.1884rem, 0.1741rem + 0.0713vw, 0.2294rem);
        --step--5: clamp(0.2261rem, 0.205rem + 0.1055vw, 0.2867rem);
        --step--4: clamp(0.2713rem, 0.241rem + 0.1515vw, 0.3584rem);
        --step--3: clamp(0.3255rem, 0.2829rem + 0.213vw, 0.448rem);
        --step--2: clamp(0.3906rem, 0.3317rem + 0.2946vw, 0.56rem);
        --step--1: clamp(0.4688rem, 0.3883rem + 0.4022vw, 0.7rem);
        --step-0: clamp(0.5625rem, 0.4538rem + 0.5435vw, 0.875rem);
        --step-1: clamp(0.675rem, 0.5293rem + 0.7283vw, 1.0938rem);
        --step-2: clamp(0.81rem, 0.6162rem + 0.969vw, 1.3672rem);
        --step-3: clamp(0.972rem, 0.7157rem + 1.2817vw, 1.709rem);
        --step-4: clamp(1.1664rem, 0.8291rem + 1.6867vw, 2.1362rem);
        --step-5: clamp(1.3997rem, 0.9577rem + 2.2098vw, 2.6703rem);
        --step-6: clamp(1.6796rem, 1.1028rem + 2.8839vw, 3.3379rem);
}
        *,html{  
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: azure;
            flex-direction: column;
            font-family: 'Poppins', 'Arial', sans-serif;
        }
        form {
            display: flex;
            flex-direction: column;
            width: 30vw;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: burlywood;
            margin-block: 2%;
        }
        label {
            margin-block: 5%;
        }
        .form-icon {
            margin-right: 8px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button:hover {
            background-color: forestgreen;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5%;
            border: none;
            border-radius: 5px;
            background-color: darkseagreen;
            color: white;
            cursor: pointer;
        }
        #backButton {
            margin-top: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: darkslategray;
            color: white;
            cursor: pointer;
            width: 10%;
        }
        @media (max-width: 550px){
            form{
                width: 70%;
            }
            #backButton{
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <h2>Forgot Password</h2>
    <form action="forgot_password.php" method="post">
        <label for="email"><i class="fas fa-envelope form-icon"></i>Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" value="Reset Password" name="resetSubmit">Reset Password</button>
    </form>
</body>
<button onclick="window.history.back();" type="button" id="backButton">Go Back</button>

</html>
<?php ob_end_flush(); ?>