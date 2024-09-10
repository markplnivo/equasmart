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
  /* Removed hamburger menu styles */
  
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
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.0); /* Add shadow effect */
  }

  .menu_box button {
    display: block;
    margin: 0 auto;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1); /* Add shadow effect */
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
</style>

<body>
  <div>
    <ul class="menu_box">
      <li><img src="../images/equasmartlogo_croppedlogo.png" alt="Logo" width="100" height="100"></li>
      <li><div class="menu_spacer"></div></li>
      <li><a class="menu_item" href="admin_home.php">Home</a></li>
      <li><a class="menu_item" href="admin_recyclebin.php">Recycle Bin</a></li>
      <li><a class="menu_item" href="admin_userlist.php">User List</a></li>
      <li><a class="menu_item" href="admin_invite.php">Invite User</a></li>
      <li><div class="menu_spacer"></div></li>
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
</body>

</html>
<?php ob_end_flush(); ?>
