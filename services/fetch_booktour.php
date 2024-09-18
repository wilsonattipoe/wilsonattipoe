<?php
include("./Database/connect.php");
include("../Admin/Database/conn.php");

$response = [
    'status' => 'ok',
    'success' => false,
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['userID'])) {
        $id = $_POST['id'];
        $userID = $_POST['userID'];

        $insertQuery = "INSERT INTO `bookTours`(`tour_id`, `ClientUserID`) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss", $id, $userID);

        if ($stmt->execute()) {
            $response = [
                'status' => 'ok',
                'success' => true,
                'message' => 'Tour booked successfully',
                'redirect' => '../Admin/user_Details.php'
            ];
        } else {
            $response = [
                'status' => 'error',
                'success' => false,
                'message' => 'Failed to book tour: ' . $stmt->error,
            ];
        }

        $stmt->close();
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
