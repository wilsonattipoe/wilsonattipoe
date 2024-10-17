<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $amount = 1;
    $callback_url = "http://yourwebsite.com/payment_callback.php"; // Your callback URL

    // Prepare the payment request
    $url = "https://api.paystack.co/transaction/initialize";
    $fields = [
        'email' => $email,
        'amount' => $amount,
        'currency' => 'GHS',
        'callback_url' => $callback_url
    ];

    $fields_string = http_build_query($fields);

    // Open connection
    $ch = curl_init();

    // Set the URL, number of POST vars, and POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer YOUR_SECRET_KEY",
        "Cache-Control: no-cache",
    ));

    // Execute post
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    if ($response['status']) {
        // Redirect the user to Paystack payment page
        header('Location: ' . $response['data']['authorization_url']);
    } else {
        // Handle error
        echo "Failed to initialize payment";
    }
}
?>
