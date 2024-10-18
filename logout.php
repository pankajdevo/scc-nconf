<?php
include 'config.php'; // Include your database configuration file
session_start(); // Start the session
if (isset($_SESSION['username'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['usersSession']);
    unset($_SESSION['username']);
    @header("Location: sign-in.php"); // Redirect to login if no session is found
    exit();
}
?>