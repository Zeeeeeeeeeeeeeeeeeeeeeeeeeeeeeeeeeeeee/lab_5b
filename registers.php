<?php
session_start();
include 'database.php';
include 'User.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']); // For example, 'student' or 'lecturer'

    // Validate inputs (optional)
    if (empty($matric) || empty($name) || empty($password) || empty($role)) {
        echo "Please fill in all fields.";
    } else {
        // Register the user in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the password

        if ($user->createUser($matric, $name, $hashed_password, $role)) {
            // Registration successful, redirect to login
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Could not register the user.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="registers.php">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
