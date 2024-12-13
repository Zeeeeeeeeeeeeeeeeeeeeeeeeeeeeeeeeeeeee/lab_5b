<?php
session_start();
include 'database.php';
include 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $loginUser = $user->login($matric, $password);
    if ($loginUser) {
        $_SESSION['matric'] = $loginUser['matric'];
        $_SESSION['role'] = $loginUser['role']; // Store role in session
        header("Location: read.php");
        exit();
    } else {
        echo "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <h2>Login Page</h2>
    <form action="authenticate.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="registers.php">Register here</a>.</p>
</body>

</html>
