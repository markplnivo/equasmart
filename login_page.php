<?php ob_start(); ?>
<?php 
include "logindbase.php"; 
include "session_handler.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: #f6f7fb;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            width: 900px;
            height: 500px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.9);
            border-radius: 10px;
            overflow: hidden;
        }

        .image-section {
            width: 50%;
            background: #f6f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .image-section img {
            width: 200px;
            height: 200px;
        }

        .login-section {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-section h2 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .form-field {
            margin-bottom: 20px;
            position: relative;
        }

        .form-field input[type="text"],
        .form-field input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 16px;
            color: #333;
            padding-left: 50px;
            background: #f1f1f1;
            box-sizing: border-box;
        }

        .form-field input[type="text"]::placeholder,
        .form-field input[type="password"]::placeholder {
            color: #aaa;
        }

        .form-field i {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 18px;
        }

        .form-field input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 50px;
            background-color: #28a745;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-field input[type="submit"]:hover {
            background-color: #218838;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .form-options a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }

        .form-options a:hover {
            color: #0056b3;
        }
    </style>
</head>

<?php
if (isset($_POST['loginSubmit'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; 

    // Use BINARY to enforce case-sensitive username search
    $sql = $conn->prepare("SELECT UserID, Username, PasswordHash, position FROM users WHERE BINARY Username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $sql->bind_result($userID, $username, $passwordHash, $position);
    
    // Check if any result was returned
    if ($sql->fetch()) {
        // Case-sensitive password verification
        if (password_verify($password, $passwordHash)) {
            loginUser($username, $position, $userID);
            session_regenerate_id(true);

            switch ($position) {
                case 'admin':
                    header("Location: ./admin/admin_home.php");
                    exit();
                default: 
                    header("Location: ./user_dashboard.php");
                    exit();
            }
        } else {
            // If password doesn't match, show alert
            echo "<script>alert('Your account and/or password is incorrect, please try again.');</script>";
        }
    } else {
        // If username doesn't exist, show alert
        echo "<script>alert('Your account and/or password is incorrect, please try again.');</script>";
    }

    $sql->close();
}
$conn->close();
?>

<body>
    <div class="container">
        <div class="image-section">
            <img src="./images/equasmartlogo_nobackground.png" alt="EquaSmart Logo">
        </div>
        <div class="login-section">
            <h2> Login</h2>
            <form action="login_page.php" method="post">
                <div class="form-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-field">
                    <input type="submit" name="loginSubmit" value="LOGIN">
                </div>
                <div class="form-options">
                    <a href="#">Forgot Username / Password?</a>
                    <a href="signup.php">Create your Account →</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>
