<?php ob_start(); ?>
<?php include "session_handler.php"; 

if (!isLoggedIn()) {
    header("Location: ../login_page.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
    <link rel="stylesheet" href="css/css/all.min.css">
    <link rel="stylesheet" href="css/css/fontawesome.min.css">
    <title>Responsive Custom Menu Bar</title>
    <style>
        *, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", 'Poppins', 'Arial', sans-serif;
        }

        /* Default Menu Styles */
        .custom-menu {
            position: fixed;
            width: 265px;
            height: 100vh;
            background-color: #21232d;
            transition: transform 0.3s ease;
            transform: translateX(0); /* Default is visible */
            z-index: 1000;
        }

        .custom-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
            align-items: center;
            display: block;
        }

        .custom-menu li {
            width: 100%;
        }

        .custom-menu li a {
    position: relative;
    display: flex;
    align-items: center;
    color: #9799ab;
    text-decoration: none;
    padding: 15px;
    overflow: hidden;
    transition: color 0.3s ease;
}

        .custom-menu li:hover a {
            color: #fff; /* Change text color on hover */
        }

        .custom-menu li a::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(0, 123, 255, 0.3); /* Ripple color */
    border-radius: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
    transition: width 0.5s ease, height 0.5s ease;
}

.custom-menu li:hover a::before {
    width: 300px; /* Adjust size for ripple effect */
    height: 300px; /* Adjust size for ripple effect */
}


        .custom-menu li:hover a {
            color: #fff; /* Change text color on hover */
        }



        .icon {
            min-width: 40px;
            text-align: center;
            font-size: 1.5em;
        }

        .nav-text {
            margin-left: 15px;
            font-size: 1em;
        }

        #menuLogo {
            margin: 20px auto;
            width: 50%;
            display: block;
        }

        .logout button {
            background: none;
            border: none;
            color: #9799ab;
            font-size: 1.2em;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        /* Hamburger Button */
        .hamburger {
            position: fixed;
            top: 15px;
            left: 15px;
            font-size: 2rem;
            color: black;
            background: none;
            border: none;
            z-index: 1100;
            cursor: pointer;
            display: none; /* Hidden by default */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .custom-menu {
                width: 200px;
                transform: translateX(-100%); /* Hidden by default */
            }

            .custom-menu.open {
                transform: translateX(0); /* Slide into view */
            }

            .hamburger {
                display: block; /* Show hamburger button */
            }

            .nav-text {
                display: none; /* Hide text by default */
            }

            .custom-menu.open .nav-text {
                display: inline-block; /* Show text when menu is open */
            }
        }
    </style>
</head>
<body>
    <!-- Hamburger Button -->
    <button class="hamburger">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Custom Menu -->
    <div class="custom-menu">
        <img src="./images/equasmartlogo_croppedlogo.png" alt="EquaSmart Logo" id="menuLogo">
        <ul>
            <li>
                <a href="user_dashboard.php">
                    <span class="icon fa fa-home"></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="feed_settings.php">
                    <span class="icon fa fa-fish"></span>
                    <span class="nav-text">Feed Settings</span>
                </a>
            </li>
            <li>
                <a href="water_settings.php">
                    <span class="icon fa fa-water"></span>
                    <span class="nav-text">Water Settings</span>
                </a>
            </li>
            <li>
                <a href="print_logs.php">
                    <span class="icon fa fa-scroll"></span>
                    <span class="nav-text">Print Reports</span>
                </a>
            </li>
            <li>
                <a href="machine_gallery.php">
                    <span class="icon fa fa-image"></span>
                    <span class="nav-text">Machine Gallery</span>
                </a>
            </li>
        </ul>
        <form action="user_menu.php" method="post">
            <ul class="logout">
                <li>
                    <a href="#">
                        <form action="user_menu.php" method="post">
                            <button name="logout">
                            <span class="icon fa fa-power-off"></span>
                                <span class="nav-text">Logout</span>
                            </button>
                            <?php if (isset($_POST['logout'])) {
                                logoutUser();
                                header("Location: login_page.php");
                            } ?>
                    </a>
                </li>
            </ul>
        </form>
            </li>
        </ul>
    </div>

    <!-- JavaScript for Hamburger Menu -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const menu = document.querySelector(".custom-menu");
            const hamburger = document.querySelector(".hamburger");

            // Toggle the menu on hamburger click
            hamburger.addEventListener("click", () => {
                menu.classList.toggle("open");
            });
        });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
