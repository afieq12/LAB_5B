<!-- update_user.php -->
<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "lab_5b");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
} else {
    die("No matric provided for update!");
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <form method="POST">
        Matric (Read-only): <input type="text" name="matric" value="<?= $user['matric'] ?>" readonly><br>
        Name: <input type="text" name="name" value="<?= $user['name'] ?>" required><br>
        Role: 
        <select name="role" required>
            <option value="Lecturer" <?= $user['role'] === 'Lecturer' ? 'selected' : '' ?>>Lecturer</option>
            <option value="Student" <?= $user['role'] === 'Student' ? 'selected' : '' ?>>Student</option>
        </select><br>
        <button type="submit">Update</button>
        <a href="user.php">Cancel</a>
    </form>
</body>
</html>
