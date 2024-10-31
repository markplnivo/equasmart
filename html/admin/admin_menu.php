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
}
</style>

<div class="custom-menu">
    <img src="../images/equasmartlogo_croppedlogo.png" alt="Logo" id="menuLogo">
    <ul>
        <li>
            <a href="admin_home.php">
                <span class="icon fa fa-home"></span>
                <span class="nav-text">Home</span>
            </a>
        </li>
        <li>
            <a href="admin_recyclebin.php">
                <span class="icon fa fa-recycle"></span>
                <span class="nav-text">Recycle Bin</span>
            </a>
        </li>
        <li>
            <a href="admin_userlist.php">
                <span class="icon fa fa-users"></span>
                <span class="nav-text">User List</span>
            </a>
        </li>
        <li>
            <a href="admin_invite.php">
                <span class="icon fa fa-envelope"></span>
                <span class="nav-text">Invite User</span>
            </a>
        </li>
    </ul>
    <form action="admin_menu.php" method="post">
        <ul class="logout">
            <li>
                <a href="#">
                    <form action="admin_menu.php" method="post">
                        <span class="icon fa fa-power-off"></span>
                        <button class="nav-text" name="logoutButton">Logout</button>
                    </form>
                </a>
            </li>
        </ul>
    </form>
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
