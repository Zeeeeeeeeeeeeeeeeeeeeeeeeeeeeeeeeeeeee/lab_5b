<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>
