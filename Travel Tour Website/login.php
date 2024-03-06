<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(photos/images.jpg);
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo {
            border-radius: 50%;
            margin-right: 10px; /* Adjust margin as needed */
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type="text"],
        input[type="password"],
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <img src="./photos/images.jpg" alt="Logo" class="logo" style="max-width: 100px;">
            Travel
        </h1>
        <h2>Login</h2>
        <form id="loginForm" action="login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        // Form Validation
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const username = this.elements['username'].value.trim();
            const password = this.elements['password'].value.trim();
            
            if (!username || !password) {
                alert('Please fill in all fields.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
