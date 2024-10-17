<?php
if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
    $url = "https://api.paystack.co/transaction/verify/" . $reference;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer YOUR_SECRET_KEY",
        "Cache-Control: no-cache",
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    if ($response['status']) {
        // Payment was successful, handle successful transaction (e.g., save to database)
        echo "Payment Successful. Reference: " . $reference;
    } else {
        // Payment failed, handle the error
        echo "Payment Failed. Reference: " . $reference;
    }
} else {
    echo "No reference supplied";
}
?>
