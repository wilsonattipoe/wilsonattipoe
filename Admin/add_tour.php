<?php
session_start();

// Include database configuration
include('../Admin/Database/connect.php');

// Check if AdminUserID is set in the session
if (!isset($_SESSION['AdminUserID'])) {
    $response['success'] = false;
    $response['message'] = "User not logged in.";
    echo json_encode($response);
    exit;
}

$adminusers = $_SESSION['AdminUserID'];

// Retrieve form data
$tourName = $_POST['tourName'];
$tourPersons = $_POST['tourPersons'];
$tourPrice = $_POST['tourPrice'];
$tourDescription = $_POST['tourDescription'];
$tourDuration = $_POST['tourDuration'];
$tourSite = $_POST['tourSite'];
$Tourstat = $_POST['tourstat'];

// Handle file upload
$tourImage = $_FILES['tourImage']['name'];
$tourImageTmp = $_FILES['tourImage']['tmp_name'];
$uploadDir = '../uploads/';
$uploadFile = $uploadDir . basename($tourImage);

$response = array();

if (move_uploaded_file($tourImageTmp, $uploadFile)) {
    // Prepare and execute the SQL statement to insert the tour
    $stmt = $conn->prepare("INSERT INTO tours (TourName, tourdescription, Price, tourimages, numberperson, AdminUserID, TourDuration, tour_site_id, tourStat_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssdssssis", $tourName, $tourDescription, $tourPrice, $tourImage, $tourPersons, $adminusers, $tourDuration, $tourSite, $Tourstat);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "New tour added successfully";

        // Log the activity
        $action = "Added new tour: " . $tourName;
        $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the IP address

        // Prepare and execute the SQL statement to insert the log
        $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
        $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $tourName);

        $logStmt->execute();
        $logStmt->close();

    } else {
        $response['success'] = false;
        $response['message'] = "Failed to add new tour: " . $stmt->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = "Failed to upload image.";
}

$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
