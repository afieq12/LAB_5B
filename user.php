<!-- display_users.php -->
<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "lab_5b");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Users</title>
</head>
<body>
    <h1>User List</h1>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['matric']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['role']; ?></td>
                <td>
                    <a href="update.php?matric=<?= $row['matric']; ?>">Update</a> |
                    <a href="delete.php?matric=<?= $row['matric']; ?>" 
                       onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
