<?php
include("./Database/connect.php");

// Prepare default response
$response = [
    'status' => 'error',
    'success' => false,
    'message' => 'Unknown error occurred',
];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate required parameters
    if (isset($_POST['userID']) && isset($_POST['id'])) {
        $userID = $_POST['userID'];
        $tourID = $_POST['id']; // Assuming 'id' refers to 'tour_ID'

        // Check if the tour is already in the user's cart
        $checkQuery = "SELECT * FROM `AddCart` WHERE `tourID` = ? AND `ClientUserID` = ?";
        $checkStmt = $conn->prepare($checkQuery);

        if ($checkStmt === false) {
            $response['message'] = 'Failed to prepare check statement: ' . $conn->error;
        } else {
            $checkStmt->bind_param("ss", $tourID, $userID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // The tour is already in the cart
                $response['message'] = 'This tour is already in your cart.';
            } else {
                // Proceed to add the tour to the cart
                $insertQuery = "INSERT INTO `AddCart`(`tourID`, `ClientUserID`) VALUES (?, ?)";
                $insertStmt = $conn->prepare($insertQuery);

                if ($insertStmt === false) {
                    $response['message'] = 'Failed to prepare insert statement: ' . $conn->error;
                } else {
                    $insertStmt->bind_param("ss", $tourID, $userID);

                    if ($insertStmt->execute()) {
                        // Success response
                        $response = [
                            'status' => 'ok',
                            'success' => true,
                            'message' => 'Added to cart successfully',
                            'redirect' => './Booking.php', // Optional redirect URL
                        ];
                    } else {
                        $response['message'] = 'Failed to add to cart: ' . $insertStmt->error;
                    }

                    $insertStmt->close();
                }
            }

            $checkStmt->close();
        }
    } else {
        $response['message'] = 'Invalid request: missing parameters';
    }
} else {
    $response['message'] = 'Invalid request method';
}

// Close the database connection
mysqli_close($conn);

// Send the response as JSON
echo json_encode($response);
