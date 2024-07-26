<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New User</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Register New User</h2>
        <form action="register_process.php" method="post">
            <div class="form-group">
                <label for="new_name">Name:</label>
                <input type="text" id="new_name" name="new_name" required>
            </div>
            <div class="form-group">
                <label for="new_username">Username:</label>
                <input type="text" id="new_username" name="new_username" required>
            </div>
            <div class="form-group">
                <label for="new_password">Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="new_location">Location:</label>
                <input type="text" id="new_location" name="new_location" required>
            </div>
            <div class="form-group">
                <label for="new_address">Address:</label>
                <input type="text" id="new_address" name="new_address" required>
            </div>
            <div class="form-group">
                <label for="new_number">Phone Number:</label>
                <input type="tel" id="new_number" name="new_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                <small>Format: 123-456-7890</small>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
