<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('../Profile/Database/connect.php');

// Fetch the userID from the session
$userID = $_SESSION['ClientUserID'];

// Fetch whitelisted places for the logged-in user
$sql = "SELECT whitelist_id, place_name FROM whitelist WHERE is_active = 1 AND clientusers = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . $conn->error]);
    exit();
}

$stmt->bind_param('i', $userID);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $places = array();

    while ($row = $result->fetch_assoc()) {
        $places[] = $row;
    }

    echo json_encode(['success' => true, 'places' => $places]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error fetching whitelist places: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
