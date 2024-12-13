<?php
include 'session_check.php';
// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

// Check if the user is an lecturer
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'lecturer';

include 'database.php';
include 'User.php';


$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px; /* Reduce padding to make the table fit more closely */
            white-space: nowrap; /* Prevent extra spaces */
        }

        th {
            background-color: #f2f2f2; /* Optional: Light gray header */
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>User List</h1>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars(trim($row["matric"])); ?></td>
                    <td><?php echo htmlspecialchars(trim($row["name"])); ?></td>
                    <td><?php echo htmlspecialchars(trim($row["role"])); ?></td>
                    <?php if ($is_admin) { ?>
                        <td>
                            <a href="update_form.php?matric=<?php echo $row["matric"]; ?>">Update</a>
                        </td>
                        <td>
                            <a href="delete.php?matric=<?php echo $row["matric"]; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    <?php } else { ?>
                        <td colspan="2" style="text-align: center;">Not Allowed</td>
                    <?php } ?>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
    </table>

    <a href="logout.php">Logout</a>

</body>

</html>
