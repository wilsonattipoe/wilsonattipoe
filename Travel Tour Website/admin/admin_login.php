<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="admin_login_process.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <div class="additional-links">
                <p>create account? <a href="account.php">Create account here</a></p>
                <p>Don't have an account? <a href="register.php">Register Here</a></p>
                <p>Forgot your password? <a href="forgot_password.php">Forgot Password</a></p>
            </div>
        </form>
    </div>
</body>
</html>
