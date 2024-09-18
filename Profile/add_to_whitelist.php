


<?php
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include '../Profile/Database/connect.php';

$userID = $_SESSION['ClientUserID'];
$username = ucwords($_SESSION['Username']);

$placeName = isset($_POST['placeName']) ? $_POST['placeName'] : null;
$reasons = isset($_POST['reasons']) ? $_POST['reasons'] : null;
$date = date('Y-m-d H:i:s');
$roleID = $_SESSION['RoleID']; 

$response = array();

// Check if place already exists
$sql = "SELECT * FROM whitelist WHERE place_name = ? AND clientusers = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $placeName, $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response['success'] = false;
    $response['message'] = 'Place already exists in the whitelist';
} else {
    // Insert place into whitelist with all fields
    $sql = "INSERT INTO whitelist (place_name, created_at, roleID, clientusers) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $placeName, $date, $roleID, $userID);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Place added to whitelist successfully';
    } else {
        $response['success'] = false;
        $response['message'] = 'Failed to add place to whitelist';
    }
}

echo json_encode($response);

mysqli_close($conn);
?>
