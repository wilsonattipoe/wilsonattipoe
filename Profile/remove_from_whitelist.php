<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Database connection
include('../Profile/Database/connect.php');

// Get input data
$placeId = $_POST['placeId'] ?? '';
$reasonRemove = $_POST['reason_remove'] ?? '';

if (empty($placeId) || empty($reasonRemove)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    exit;
}

// Prepare and execute the update statement
$sql = 'UPDATE whitelist SET is_active = 0, removal_reason = ? WHERE whitelist_id = ?';
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare the SQL statement.']);
    exit;
}

$stmt->bind_param('si', $reasonRemove, $placeId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Place marked as inactive successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to mark place as inactive.']);
}

$stmt->close();
$conn->close();
?>
