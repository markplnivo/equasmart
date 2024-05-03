<?php ob_start(); ?>
<?php include "logindbase.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: whitesmoke;
      display: flex;
      align-items:center;
      height: 100vh;
      margin: 0;
      flex-direction: column;
      justify-content: center;
    }

    .form-container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-field {
      margin-bottom: 15px;
      position: relative;
    }

    .form-field input[type="text"],
    .form-field input[type="password"] {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-field input::placeholder {
      color: #aaa;
    }

    .terms-policy {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .terms-policy input[type="checkbox"] {
      margin-right: 10px;
    }

    .terms-policy h3 {
      margin: 0;
      font-weight: normal;
    }

    .form-action {
      text-align: center;
    }

    .form-action input[type="submit"] {
      padding: 10px 20px;
      background: mediumaquamarine;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-redirect h3 {
      text-align: center;
      font-weight: normal;
    }

    .login-redirect a {
      color: mediumaquamarine;
      text-decoration: none;
    }

    #logo {
      margin-bottom: 15px;
    }
  </style>
</head>

<?php
if (isset($_POST['registrationSubmit'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $email = $conn->real_escape_string($_POST['email']);
  $contactNumber = $conn->real_escape_string($_POST['contactNumber']);
  $password = $conn->real_escape_string($_POST['password']);

  // Hash the password for security
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  // SQL query to insert data into the users table
  $sql = "INSERT INTO users (Username, PasswordHash, EmailAddress, ContactNumber) VALUES ('$username', '$passwordHash', '$email', '$contactNumber')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Your account has been created successfully!');</script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}



?>

<body>
  <img id="logo" src="./images/equasmartlogo_croppedlogo.png" alt="EquaSmart Logo" style="width: 200px; height: auto;">
  <div class="form-container">
    <h2>Registration</h2>
    <form action="signup.php" method="post">
      <div class="form-field">
        <input type="text" name="username" placeholder="Enter your name" required>
      </div>
      <div class="form-field">
        <input type="text" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-field">
        <input type="text" name="contactNumber" placeholder="Enter your contact number" required>
      </div>
      <div class="form-field">
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>
      <!-- <div class="terms-policy">
                <input type="checkbox">
                <h3>I accept all terms & conditions</h3>
            </div> -->
      <div class="form-field form-action">
        <input type="submit" name="registrationSubmit" value="Register Now">
      </div>
      <div class="login-redirect">
        <h3>Already have an account? <a href="login_page.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>

</html>
<?php ob_end_flush(); ?>