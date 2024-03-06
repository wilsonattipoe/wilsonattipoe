<!DOCTYPE html>
<html>
<head>
    <title>Fastest Travel Mode Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        p {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Fastest Travel Mode Calculator</h1>
    </header>

    <div class="container">
        <form method="post">
            <label for="distance">Distance to travel (in kilometers):</label><br>
            <input type="text" name="distance" id="distance"><br><br>
            <input type="submit" value="Calculate">
        </form>

        <?php
        function fastest_travel($distance) {
            // Assuming average speeds for different modes of transportation
            $airplane_speed = 800; // in km/h
            $high_speed_train_speed = 300; // in km/h
            $private_jet_speed = 1000; // in km/h

            // Calculate time taken by each mode of transportation
            $airplane_time = $distance / $airplane_speed;
            $high_speed_train_time = $distance / $high_speed_train_speed;
            $private_jet_time = $distance / $private_jet_speed;

            // Find the minimum time
            $fastest_time = min($airplane_time, $high_speed_train_time, $private_jet_time);

            // Determine the fastest mode of transportation
            if ($fastest_time == $airplane_time) {
                return "Airplane";
            } elseif ($fastest_time == $high_speed_train_time) {
                return "High-speed Train";
            } else {
                return "Private Jet";
            }
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if distance is provided
            if (!empty($_POST["distance"])) {
                $distance_to_travel = $_POST["distance"];
                $fastest_mode = fastest_travel($distance_to_travel);
                echo "<p>The fastest mode of transportation for a distance of $distance_to_travel kilometers is: $fastest_mode</p>";
            } else {
                echo "<p>Please enter the distance to travel.</p>";
            }
        }
        ?>
    </div>

    <footer>
        <p style="text-align: center;">&copy; 2024 Fastest Travel Mode Calculator</p>
    </footer>
</body>
</html>
