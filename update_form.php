<?php
include 'database.php';
include 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

// Fetch user data based on matric passed via GET
$matric = $_GET['matric'] ?? '';
$userData = $user->getUserByMatric($matric); // Implement a method to fetch user details by matric

if (!$userData) {
    echo "User not found!";
    exit();
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
    <h1>Update User</h1>
    <form action="update_user.php" method="post">
        <label for="new_matric">New Matric:</label>
        <input type="text" id="new_matric" name="new_matric" value="<?php echo htmlspecialchars($userData['matric']); ?>" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="student" <?php echo ($userData['role'] === 'student') ? 'selected' : ''; ?>>Student</option>
            <option value="lecturer" <?php echo ($userData['role'] === 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
        </select><br>

        <input type="hidden" name="old_matric" value="<?php echo htmlspecialchars($userData['matric']); ?>">
        <button type="submit">Update</button>
    </form>
</body>
</html>
