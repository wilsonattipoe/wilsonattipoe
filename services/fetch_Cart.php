<?php
include("./Database/connect.php");

$response = [
    'status' => 'ok',
    'success' => false,
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if userID is set
    if (isset($_POST['userID'])) {
        $userID = $_POST['userID'];

        // Prepare the SQL statement
        $insertQuery = "INSERT INTO `AddCart`(`ClientUserID`) VALUES (?)";
        $stmt = $conn->prepare($insertQuery);

        if ($stmt === false) {
            $response = [
                'status' => 'error',
                'success' => false,
                'message' => 'Failed to prepare the statement: ' . $conn->error,
            ];
        } else {
            $stmt->bind_param("s", $userID);

            if ($stmt->execute()) {
                $response = [
                    'status' => 'ok',
                    'success' => true,
                    'message' => 'Added to cart successfully',
                    'redirect' => './Booking.php'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Failed to add to cart: ' . $stmt->error,
                ];
            }

            $stmt->close();
        }
    } else {
        $response = [
            'status' => 'error',
            'success' => false,
            'message' => 'Invalid request: missing parameters',
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'success' => false,
        'message' => 'Invalid request method',
    ];
}

mysqli_close($conn);

// Send the JSON response
echo json_encode($response);
?>
