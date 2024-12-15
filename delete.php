<!-- delete_user.php -->
<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['matric'])) {
    $conn = new mysqli("localhost", "root", "", "lab_5b");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $matric = $_GET['matric'];
    $sql = "DELETE FROM users WHERE matric='$matric'";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
    $conn->close();
    header("Location: user.php");
    exit;
} else {
    die("No matric provided for deletion!");
}
?>
