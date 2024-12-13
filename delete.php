<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'lecturer') {
    echo "Access Denied. Only admins can access this page.";
    exit();
}

include 'database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->deleteUser($matric);

    echo "User deleted successfully.";
    header("Location: read.php");
    exit();
}
