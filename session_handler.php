<?php
ob_start();
include "logindbase.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

function loginUser($username, $user_id)
{
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;
}

function logoutUser()
{
    // Proceed to clear the session
    $_SESSION = array(); // Clear the session variables.
    session_destroy(); // Destroy the session.
}

function isLoggedIn()
{
    return isset($_SESSION['username']);
}
ob_end_flush();
?>