<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Around the World</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .country {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            width: 250px;
        }

        .country h2 {
            margin-top: 0;
        }

        .country img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Around the World</h1>
    </header>

    <div class="container">
        <?php
        // API endpoint
        $api_url = 'https://restcountries.com/v3.1/all';

        // Fetch data from the API
        $response = file_get_contents($api_url);

        // Decode JSON response
        $countries = json_decode($response, true);

        // Check if the API request was successful
        if ($countries) {
            // Display information about each country
            foreach ($countries as $country) {
                echo '<div class="country">';
                echo '<h2>' . $country['name']['common'] . '</h2>';
                
                // Check if 'flags' key exists and is a non-empty array
                if (isset($country['flags']) && is_array($country['flags']) && array_key_exists(0, $country['flags'])) {
                    echo '<img src="' . $country['flags'][0] . '" alt="' . $country['name']['common'] . ' Flag">';
                } else {
                    echo '<p>No flag available</p>';
                }
                
                echo '<p><strong>Population:</strong> ' . number_format($country['population']) . '</p>';
                
                // Check if 'capital' key exists and is a non-empty array
                if (isset($country['capital']) && is_array($country['capital']) && array_key_exists(0, $country['capital'])) {
                    echo '<p><strong>Capital:</strong> ' . $country['capital'][0] . '</p>';
                } else {
                    echo '<p>Capital information not available</p>';
                }
                
                echo '</div>';
            }
        } else {
            // If API request fails, display an error message
            echo '<p class="error">Failed to fetch data from the API.</p>';
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Around the World</p>
    </footer>
</body>
</html>
