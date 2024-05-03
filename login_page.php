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
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: whitesmoke;
            font-family: 'Verdana', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-title a {
            text-decoration: none;
            color: mediumaquamarine;
            font-size: 1.2em;
        }

        form {
            max-width: 300px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            width: 25vw;
            border-radius: 10px;
            display:flex;
            flex-direction:column;
        }

        .form-field {
            position: relative;
            margin: 20px 0;
        }

        .form-field input[type="text"],
        .form-field input[type="password"] {
            width: 80%;
            padding: 10px;
            background: none;
            border: none;
            border-bottom: 1px solid gray;
            font-size: 16px;
            color: #333;
        }

        .form-field label {
            position: absolute;
            top: -20px;
            left: 0;
            font-size: 16px;
            color: #333;
        }

        .form-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-content a {
            font-size: 14px;
        }

        .form-field input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background: mediumaquamarine;
            color: white;
            cursor: pointer;

        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            color: #333;
            font-size: 14px;
        }

        .pass-link {
            margin-top: 10px;
            text-align: center;

        }

        .login-title img {
            width: auto;
            height: 200px;
        }
    </style>
</head>

<?php
if (isset($_POST['loginSubmit'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; 

    $sql = $conn->prepare("SELECT UserID, PasswordHash FROM users WHERE Username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $sql->bind_result($userID, $passwordHash);
    $sql->fetch();
    $sql->close();

    if (password_verify($password, $passwordHash)) {
        loginUser($username, $userID); // Use loginUser from session_handler.php

        // Redirect to a new page after successful login
        header("Location: user_dashboard.php"); // Adjust the redirection to your desired page
        exit();
    } else {
        echo "<script>alert('Invalid username/password combination.');window.location.href='login_form.php';</script>";
    }
    $conn->close();
}
?>


<body>
    <div class="login-title">
        <img src="./images/equasmartlogo_nobackground.png" alt="EquaSmart Logo" id="menuLogo">
    </div>
    <form action="login_page.php" method="post">
        <div class="form-field">
            <input type="text" id="username" name="username" required>
            <label>USERNAME</label>
        </div>
        <div class="form-field">
            <input type="password" id="password" name="password" required>
            <label>PASSWORD</label>
        </div>
        <!-- <div class="form-content">
            <div class="checkbox">
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
        </div> -->
        <div class="form-field">
            <input type="submit" name="loginSubmit" value="Login">
        </div>
        <div class="signup-link">
            Not a member? <a href="signup.php">Sign-up now</a>
        </div>
        <div class="pass-link">
            <a href="#">Forgot password?</a>
        </div>
    </form>
</body>

</html>
<?php ob_end_flush(); ?>