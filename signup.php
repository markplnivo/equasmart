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
      align-items: center;
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

    #moreContent {
  display: none;
  margin-top: 15px;
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 5px;
  background: #f9f9f9;
}

#moreContent.show {
  display: block;
}


    .input-box label a {
      color: mediumaquamarine;
      cursor: pointer;
    }
  </style>
</head>

<?php
if (isset($_POST['registrationSubmit'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $email = $conn->real_escape_string($_POST['email']);
  $contactNumber = $conn->real_escape_string($_POST['contactNumber']);
  $password = $conn->real_escape_string($_POST['password']);
  $termsAccepted = isset($_POST['terms_and_conditions']) ? true : false;

  if ($termsAccepted) {
    // Hash the password for security
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the users table
    $sql = "INSERT INTO users (Username, PasswordHash, EmailAddress, ContactNumber) VALUES ('$username', '$passwordHash', '$email', '$contactNumber')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>
              alert('Your account has been created successfully!');
              window.location.href = 'login_page.php';
            </script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  } else {
    echo "<script>
            alert('You must accept the terms and conditions to register.');
          </script>";
  }
}
?>

<body>
  <img id="logo" src="./images/equasmartlogo_croppedlogo.png" alt="EquaSmart Logo" style="width: 10%; height: auto;">
  <div class="form-container">
    <h2>Registration</h2>
    <form action="signup.php" method="post">
      <div class="form-field">
        <input type="text" name="username" placeholder="Enter your username" required>
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
      <div class="input-box terms-policy">
        <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" required>
         <label for="terms_and_conditions">I agree to the terms and conditions <a href="javascript:void(0);" id="showMoreLink">(show more)</a></label>
      </div>
      <div id="moreContent">
        <h3>Terms and Conditions</h3>

 <p><strong>Introduction</strong></p>

<p>Welcome to Equa Smart Company. These Terms and Conditions ("Terms") govern your use of our website, products, and services related to aquaponics (collectively referred to as "Services"). By accessing or using our Services, you agree to be bound by these Terms. If you do not agree with these Terms, please do not use our Services.</p>

<p><strong>Definitions</strong></p>

<p>Aquaponics: A system that combines aquaculture (raising fish) and hydroponics (growing plants without soil) in a symbiotic environment.
User: Any person or entity using our Services.
Products: Any items sold by the Company, including but not limited to aquaponics systems, components, and related materials.
Website: Our online platform located at https://equasmart.portfoliomjp.com.
Eligibility
To use our Services, you must be at least 18 years old and have the legal capacity to enter into these Terms. By using our Services, you represent and warrant that you meet these requirements.</p>

<p><strong>Use of Services</strong></p>

<p>Account Registration: You may be required to create an account to access certain features of our Services. You are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.

Prohibited Conduct: You agree not to use our Services for any unlawful purpose or in a manner that could damage, disable, or impair our Services. Prohibited conduct includes, but is not limited to:
Compliance with Laws: You agree to comply with all applicable laws and regulations when using our Services.</p>

<p><strong>Limitation of Liability</strong></p>

<p>To the maximum extent permitted by law, the Company shall not be liable for any indirect, incidental, special, or consequential damages arising out of or in connection with your use of our Services. Our total liability to you for any damages shall not exceed the amount you paid, if any, for the use of our Services.</p>

<p><strong>Indemnification</strong></p>

<p>You agree to indemnify, defend, and hold harmless the Company, its affiliates, and their respective officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, and expenses, including reasonable attorneys' fees, arising out of or in any way connected with your access to or use of our Services.</p>

<p><strong>Changes to Terms</strong></p>

<p>We reserve the right to modify these Terms at any time. Any changes will be effective immediately upon posting on our website. Your continued use of our Services after any changes constitute your acceptance of the new Terms.</p>

<p><strong>Contact Us</strong></p>

<p>If you have any questions about these Terms, please contact us at email/hotline.</p>
      </div>
      <br>

      <div class="form-field form-action">
        <input type="submit" name="registrationSubmit" value="Submit">
      </div>
      <div class="login-redirect">
        <h3>Already have an account? <a href="login_page.php">Login now</a></h3>
      </div>
    </form>
  </div>
  <script>
  document.getElementById('showMoreLink').addEventListener('click', function() {
    var moreContent = document.getElementById('moreContent');
    moreContent.classList.toggle('show');
    if (moreContent.classList.contains('show')) {
      this.innerText = '(show less)';
    } else {
      this.innerText = '(show more)';
    }
  });
</script>

</body>

</html>
<?php ob_end_flush(); ?>
