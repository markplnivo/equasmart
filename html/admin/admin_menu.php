<?php ob_start(); ?>
<?php
include "../session_handler.php";
include "../logindbase.php";

if (!isLoggedIn()) {
  header("Location: ../login_page.php");
  exit();
}
if ($_SESSION['position'] != 'admin') {
  header("Location: ../login_page.php");
  exit();
}
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
  /* Hamburger menu styles
  #menu_toggle {
    opacity: 0;
  }

  #menu_toggle:checked+.menu_btn>span {
    transform: rotate(45deg);
  }

  #menu_toggle:checked+.menu_btn>span::before {
    top: 0;
    transform: rotate(0deg);
  }

  #menu_toggle:checked+.menu_btn>span::after {
    top: 0;
    transform: rotate(90deg);
  }

  #menu_toggle:checked~.menu_box {
    left: 0 !important;
  }

  .menu_btn {
    position: fixed;
    top: 50px;
    left: 20px;
    width: 26px;
    height: 26px;
    cursor: pointer;
    z-index: 1;
  }

  .menu_btn>span,
  .menu_btn>span::before,
  .menu_btn>span::after {
    display: block;
    position: absolute;
    width: 100%;
    height: 3px;
    background-color: #616161;
    transition-duration: .25s;
  }

  .menu_btn>span::before {
    content: '';
    top: -8px;
  }

  .menu_btn>span::after {
    content: '';
    top: 8px;
  } */

  .menu_box {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    margin: 0;
    padding: 80px 0;
    list-style: none;
    background-color: mediumaquamarine;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, .9);
  }

  .menu_box img {
    display: block;
    margin: 0 auto;
    height: 150px;
    width: auto;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.0);
    /* Add shadow effect */
  }

  .menu_box button {
    display: block;
    margin: 0 auto;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    /* Add shadow effect */
  }

  .menu_item {
    display: block;
    padding: 12px 24px;
    color: white;
    font-family: 'Roboto', sans-serif;
    font-size: 20px;
    font-weight: 600;
    text-decoration: none;
    transition-duration: .25s;
  }

  .menu_spacer {
    height: 40px;
  }

  .menu_item:hover {
    background-color: mediumseagreen;
    font-size: 25px;
  }

  body {
    grid-template-columns: 300px auto 0.5fr;
  }

  #buttonlogout {
    color: #333;
  }

  #buttonlogout:hover {
    cursor: pointer;
  }

  /* Toggle switch style */
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked+.slider {
    background-color: #4CAF50;
  }

  input:checked+.slider:before {
    transform: translateX(26px);
  }
</style>

<body>
  <div class="hamburger-menu">
    <!-- <input id="menu_toggle" type="checkbox" />
    <label class="menu_btn" for="menu_toggle">
      <span></span>
    </label> -->

    <ul class="menu_box">
      <li><img src="../images/equasmartlogo_croppedlogo.png" alt="Logo" width="100" height="100"></li>
      <li>
        <div class="menu_spacer"></div>
      </li>
      <li><a class="menu_item" href="admin_home.php">Home</a></li>
      <li><a class="menu_item" href="admin_recyclebin.php">Recycle Bin</a></li>
      <li><a class="menu_item" href="admin_userlist.php">User List</a></li>
      <!-- <li><a class="menu_item" href="admin_invite.php">Invite User</a></li> -->
      <li>
        <div class="menu_spacer"></div>
      </li>
      <!-- Toggle slider for ngrok control -->
      <div>
        <label class="switch">
          <input type="checkbox" id="ngrokToggle">
          <span class="slider"></span>
        </label>
      <p id="statusMessage"></p>
      </div>

      <li>
        <form action="admin_menu.php" method="post">
          <div class="logButton">
            <button id="buttonlogout" type="submit" name="logoutButton" class="menu_item">Logout</button>
          </div>
        </form>
      </li>
    </ul>
  </div>

  <?php
  if (isset($_POST['logoutButton'])) {
    logoutUser();
    header("Location: ../login_page.php");
    exit();
  }
  ?>

  <!-- <script>
    // Existing code
    window.addEventListener('click', function(e) {
      var menuBox = document.querySelector('.menu_box');
      var menuBtn = document.querySelector('.menu_btn');
      var menuToggle = document.querySelector('#menu_toggle');

      if (!menuBox.contains(e.target) && !menuBtn.contains(e.target) && !menuToggle.contains(e.target)) {
        menuToggle.checked = false;
        document.body.classList.remove('menu-open');
      }
    });

    var menuToggle = document.querySelector('#menu_toggle');
    menuToggle.addEventListener('change', function() {
      document.body.classList.toggle('menu-open', this.checked);
    });
  </script>  -->

  <script>
    document.getElementById('ngrokToggle').addEventListener('change', function() {
      const isChecked = this.checked;
      const url = isChecked ? 'start_ngrok.php' : 'stop_ngrok.php';
      fetch(url, {
          method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
          document.getElementById('statusMessage').textContent = data.message;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  </script>

</body>

</html>
<?php ob_end_flush(); ?>