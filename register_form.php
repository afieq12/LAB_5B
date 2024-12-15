<!-- registration.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli("localhost", "root", "", "lab_5b");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (matric, name, role, password) VALUES ('$matric', '$name', '$role', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <form method="POST">
        Matric: <input type="text" name="matric" required><br>
        Name: <input type="text" name="name" required><br>
        Role: 
        <select name="role" required>
            <option value="Lecturer">Lecturer</option>
            <option value="Student">Student</option>
        </select><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
        <a href="login.php">Login</a>
    </form>
</body>
</html>
