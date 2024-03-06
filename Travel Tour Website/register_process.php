<?php
// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate form data (you can add more validation)
if(empty($username) || empty($email) || empty($password)) {
    echo "All fields are required.";
    exit;
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Save the data to the database (this is just a placeholder, replace with your actual database code)
// Example:
// $connection = mysqli_connect("localhost", "username", "password", "database");
// $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
// mysqli_query($connection, $query);
// mysqli_close($connection);

// Assuming registration is successful, redirect to login page
header("Location: login.php");
exit;
?>
