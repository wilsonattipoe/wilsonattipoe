<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('../Profile/Database/connect.php');

// Fetch all active whitelisted places
$sql = "SELECT whitelist_id, place_name FROM whitelist WHERE is_active = 1";
$stmt = $conn->prepare($sql);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $places = array();

    while ($row = $result->fetch_assoc()) {
        $places[] = $row;
    }

    echo json_encode(['success' => true, 'places' => $places]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error fetching whitelist places.']);
}

$stmt->close();
$conn->close();
?>
