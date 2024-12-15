<?php
$conn = mysqli_connect("localhost","root","","lab_5b");

if(!$conn)
{
	die("Connection Failed : ". mysqli_connect_error());
}

$sql = "INSERT INTO users (matric, name, password, role)
		VALUES ('$_POST[matric]', '$_POST[name]', '$_POST[password]', '$_POST[role]')";

if (mysqli_query($conn,$sql))
{
	echo "Your new student information has successfully recorded. ";
	header('Location: login.php');
}
else 
{
	echo "ERROR: Could not able to execute $sql . ".mysqli_error($conn);
}

mysqli_close($conn);
?>