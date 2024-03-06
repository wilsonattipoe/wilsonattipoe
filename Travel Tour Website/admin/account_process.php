<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // You can perform validation and other checks here
    
    // Assuming you have a database connection
    // Insert the new user into the database
    // Example:
    // $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    // $result = mysqli_query($conn, $sql);
    
    // Redirect the user to the login page after successful registration
    header("Location: admin_login.php");
    exit;
}
?>
