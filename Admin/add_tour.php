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
$TourType = $_POST['tourtype'];
$Start_date = $_POST['start_date'];
$End_date = $_POST['end_date'];

// Handle file upload
$tourImage = $_FILES['tourImage']['name'];
$tourImageTmp = $_FILES['tourImage']['tmp_name'];
$uploadDir = '../uploads/';
$uploadFile = $uploadDir . basename($tourImage);

$response = array();

if (move_uploaded_file($tourImageTmp, $uploadFile)) {
    // Prepare and execute the SQL statement to insert the tour
    $stmt = $conn->prepare("INSERT INTO `tours`(`TourName`, `tourdescription`, `Price`, `tourimages`, `numberperson`, `TourDuration`, `AdminUserID`, `tourStat_id`, `tour_site_id`, `tourtype_id`, `start_date`, `end_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssdssssissss", $tourName, $tourDescription, $tourPrice, $tourImage, $tourPersons,  $tourDuration, $adminusers, $Tourstat, $tourSite, $TourType, $Start_date, $End_date);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "New tour added successfully";

        // Log the activity
        $action = "Added new tour: " . $tourName;
        $stmt = $conn->prepare("INSERT INTO audit_logs (AdminUserID, action, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $adminusers, $action);
        $stmt->execute();
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to add new tour.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Failed to upload image.";
}

echo json_encode($response);