<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <p>Please enter your email address below. We'll send you instructions on how to reset your password.</p>
        <form action="forgot_password_process.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit">Reset Password</button>
                <button type="button" onclick="window.location.href='login.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
