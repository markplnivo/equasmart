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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
  
.custom-menu {
    width: 200px;
    height: auto;
    overflow: hidden;
    background-color: mediumaquamarine;
    margin: 0;
    z-index: 1;
    display: flex;
    flex-direction: column;
}

.custom-menu ul {
    list-style-type: none;
    padding: 0;
    margin: 7px 0;
  }

.custom-menu ul.logout {
    margin-bottom: 30%;
  }

.custom-menu li {
    width: 100%;
    color: white;
}

.custom-menu li a {
    display: flex;
    align-items: center;
    color: whitesmoke;
    text-decoration: none;
    padding: 15px;
    background-color: mediumaquamarine;
  }

.custom-menu li:hover a {
    background-color: mediumseagreen;
    color: white;
}

.icon {
    min-width: 10%;
    text-align: center;
    font-size: 1.5em;
  }

.custom-menu .nav-text {
    display: flex;
    margin-left: 15px;
    font-size: 1em;
  }

#menuLogo {
    margin-top: 15px;
    align-self: center;
    width: 50%;
}

.logout button {
    background: none;
    border: none;
    color: white;
    font-size: 1.2em;
    cursor: pointer;
}

/* Mobile responsiveness */
@media (max-width: 1010px) {
    .custom-menu {
        width: 60px;
        height: auto;
        overflow: hidden;
        background-color: mediumaquamarine;
        margin: 0;
        transition: width .05s linear;
        z-index: 1;
        display: flex;
        flex-direction: column; 
    }

    .custom-menu:hover {
        display: flex;
        width: 200px;
        background: mediumaquamarine;
        overflow: visible;
    }

    .custom-menu .nav-text {
        display: none;
    }

    .custom-menu:hover .nav-text {
        display: flex;
        margin-left: 15px;
        font-size: 1em;
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
}
</style>

<body>
<div class="custom-menu">
    <!-- <input id="menu_toggle" type="checkbox" />
    <label class="menu_btn" for="menu_toggle">
      <span></span>
    </label> -->

    <ul class="menu_box">
      <li><img src="../images/equasmartlogo_croppedlogo.png" alt="Logo" width="100" height="100"></li>
      <li>
        <div class="menu_spacer"></div>
      </li>
      <li class="icon fa fa-home"><a class="menu_item" href="admin_home.php"><span class="nav-text">Home</span></a></li>
      <li class="icon fa fa-recycle"><a class="menu_item" href="admin_recyclebin.php"><span class="nav-text">Recycle Bin</span></a></li>
      <li class="icon fa fa-users"><a class="menu_item" href="admin_userlist.php"><span class="nav-text">User List</span></a></li>
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
          <span class="icon fa fa-power-off"></span>
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