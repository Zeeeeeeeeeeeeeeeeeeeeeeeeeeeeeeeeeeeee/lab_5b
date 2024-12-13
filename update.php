<?php
session_start();
include 'database.php';
include 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_matric = trim($_POST['old_matric']);
    $new_matric = trim($_POST['new_matric']);
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);

    if (empty($new_matric) || empty($name) || empty($role)) {
        echo "All fields are required.";
    } else {
        // Perform the update
        if ($user->updateUser($old_matric, $new_matric, $name, $role)) {
            header("Location: read.php"); // Redirect to the user list
            exit();
        } else {
            echo "Error: Could not update the user.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <h2>Update User</h2>
    <form action="update.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" value="<?php echo $userData['matric']; ?>" required><br><br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $userData['name']; ?>" required><br><br>
        <label for="role">Access Level:</label>
        <input type="text" name="role" id="role" value="<?php echo $userData['role']; ?>" required><br><br>
        <input type="submit" value="Update">
        <a href="read.php">Cancel</a>
    </form>
</body>

</html>
