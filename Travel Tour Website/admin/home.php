<?php
session_start();

// Check if admin is not logged in, redirect to login page
if (!isset($_SESSION['email'])) {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Dashboard</title>
    <!-- Add your CSS links here -->
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .nav-links {
            margin-bottom: 20px;
        }
        .nav-links a {
            margin-right: 20px;
            text-decoration: none;
            color: blue;
        }
        .sidebar {
            float: left;
            width: 20%;
            margin-right: 20px;
        }
        .main-content {
            float: left;
            width: 75%;
        }
        .footer {
            clear: both;
            text-align: center;
            margin-top: 20px;
        }
        .tour-package {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Travel Dashboard</h1>
            <!-- Navigation links -->
            <div class="nav-links">
                <a href="home.php">Home</a>
                <a href="#">Tour Packages</a>
                <a href="#">Bookings</a>
                <a href="#">Preferences</a>
                <a href="admin_logout.php">Logout</a>
            </div>
        </div>
        <div class="sidebar">
            <h2>Explore</h2>
            <!-- Add sidebar content or navigation links here -->
            <ul>
                <li><a href="#">Tour Packages</a></li>
                <li><a href="#">Bookings</a></li>
                <li><a href="#">Preferences</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Tour Packages</h2>
            <!-- Add tour packages dynamically -->
            <?php
            // Example array of tour packages
            $tourPackages = [
                ["name" => "Beach Getaway", "destination" => "Maldives", "price" => "$1000"],
                ["name" => "City Tour", "destination" => "New York", "price" => "$800"],
                ["name" => "Mountain Trek", "destination" => "Switzerland", "price" => "$1200"]
            ];

            foreach ($tourPackages as $package) {
                echo "<div class='tour-package'>";
                echo "<h3>{$package['name']}</h3>";
                echo "<p><strong>Destination:</strong> {$package['destination']}</p>";
                echo "<p><strong>Price:</strong> {$package['price']}</p>";
                echo "<button>Book Now</button>"; // Add booking functionality
                echo "</div>";
            }
            ?>
        </div>
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> Travel Agency</p>
            <!-- Add any footer content here -->
        </div>
    </div>
</body>
</html>