<?php
session_start();
include("./Database/connect.php"); 

header('Content-Type: application/json'); // Ensure the response is JSON
$response = array();

// Check if the required fields are present in the POST request
if (!isset($_POST['id'], $_POST['userID'], $_POST['participant'], $_POST['price'])) {
    echo json_encode(['error' => 'Missing required fields.']);
    exit();
}

$tourID = $_POST['id'];
$userID = $_POST['userID'];
$participant = (int)$_POST['participant'];
$totalPrice = (float)$_POST['price'];

// Input validation
if ($participant < 1) {
    echo json_encode(['error' => 'Invalid number of participants.']);
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['Username'])) {
    echo json_encode(['error' => 'You must be logged in to add a tour to the cart.']);
    exit();
}

// Check if the tour already exists in the cart for the user
$sqlCheck = "SELECT * FROM `booktours` WHERE ClientUserID = ? AND tour_id = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param('ii', $userID, $tourID);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo json_encode(['error' => 'This tour is already in your cart.']);
    exit();
}

$action_id = 1;

try {
    $sql = "INSERT INTO `booktours`(`ClientUserID`, `participants`, `tour_id`, `action_id`, `bookPrice`, `Dated`) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiiid', $userID, $participant, $tourID, $action_id, $totalPrice);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Booking successfully inserted.';
    } else {
        $response['error'] = 'Database insertion failed: ' . $stmt->error;
    }

    $stmt->close();
} catch (Exception $e) {
    $response['error'] = 'An unexpected error occurred: ' . $e->getMessage();
}

echo json_encode($response);
?>
