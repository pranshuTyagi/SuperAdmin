<?php
require_once 'includes/db_connection.php';

// Form data
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// SQL to insert data into users table
$sql = "INSERT INTO users (Roles, username, password) VALUES ('$role', '$username', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>