<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate form data (you can add more validation)
    if(empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit;
    }

    // Database connection settings
    $host = 'localhost'; // Your host
    $dbname = 'your_database_name'; // Your database name
    $username_db = 'your_database_username'; // Your database username
    $password_db = 'your_database_password'; // Your database password

    try {
        // Connect to the database using PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
        
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare an SQL statement to retrieve admin data from the database
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
        
        // Bind parameters to the prepared statement
        $stmt->bindParam(':username', $username);
        
        // Execute the prepared statement
        $stmt->execute();
        
        // Fetch admin data
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verify password
        if ($admin && password_verify($password, $admin['password'])) {
            // Authentication successful, set session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit;
        } else {
            // Invalid username or password
            echo "Invalid username or password.";
            exit;
        }
    } catch(PDOException $e) {
        // Handle database connection errors
        echo "Database connection failed: " . $e->getMessage();
        exit;
    }
}
?>
