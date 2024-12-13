<?php
session_start();
include 'database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $database = new Database();
    $db = $database->getConnection();

    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // Store user details in session
            $_SESSION['matric'] = $userDetails['matric'];
            $_SESSION['role'] = $userDetails['role'];

            echo "Login Successful. Welcome, " . $userDetails['name'];
            header("Location: read.php");
            exit();
        } else {
            echo "Login Failed. Incorrect matric or password.";
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
