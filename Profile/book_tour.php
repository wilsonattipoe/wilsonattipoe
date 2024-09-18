<?php
session_start();

if (!isset($_SESSION['ClientUserID'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$required_fields = ['tourID', 'bookingDate', 'participants', 'roomSelect', 'countrySelect', 'tourTypeSelect', 'tourSiteSelect'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => 'Missing parameter: ' . $field]);
        exit();
    }
}

$tourID = intval($_POST['tourID']);
$bookingDate = $_POST['bookingDate']; 
$participants = intval($_POST['participants']);
$room_id = intval($_POST['roomSelect']);
$country_id = intval($_POST['countrySelect']);
$tourType_id = intval($_POST['tourTypeSelect']);
$tourSite_id = intval($_POST['tourSiteSelect']);
$userID = $_SESSION['ClientUserID'];

// Validate date format (optional, for debugging)
if (!DateTime::createFromFormat('Y-m-d', $bookingDate)) {
    echo json_encode(['success' => false, 'message' => 'Invalid date format.']);
    exit();
}

// Database connection
include("./Database/connect.php");

// Fetch country amount
$countryQuery = $conn->prepare("SELECT countryamnt FROM countryamount WHERE country_id = ?");
$countryQuery->bind_param("i", $country_id);
$countryQuery->execute();
$countryQuery->bind_result($countryamount);
$countryQuery->fetch();
$countryQuery->close();

// Fetch room price
$roomQuery = $conn->prepare("
    SELECT ra.Amount 
    FROM room r 
    JOIN roomamount ra ON r.roomamount = ra.Amount 
    WHERE r.Room_id = ?");
$roomQuery->bind_param("i", $room_id);
$roomQuery->execute();
$roomQuery->bind_result($roomPrice);
$roomQuery->fetch();
$roomQuery->close();

// Fetch action_id for 'Pending'
$actionQuery = $conn->prepare("SELECT ActionID FROM actions WHERE ActionName = 'Pending'");
$actionQuery->execute();
$actionQuery->bind_result($action_id);
$actionQuery->fetch();
$actionQuery->close();

if (!$action_id) {
    echo json_encode(['success' => false, 'message' => 'Pending action not found in the actions table']);
    exit();
}

// Calculate total price
$totalPrice = ($countryamount + $roomPrice) * $participants;

// Insert booking
$stmt = $conn->prepare("INSERT INTO booktours (price, ClientUserID, room_id, participants, country_id, tourType_id, tourSite_id, action_id, Dated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("diidiiisi", $totalPrice, $userID, $room_id, $participants, $country_id, $tourType_id, $tourSite_id, $action_id, $bookingDate);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Booking successful']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error executing query: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
