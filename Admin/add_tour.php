<?php
session_start();

// Include database configuration
include('../Admin/Database/connect.php');

// Retrieve form data
$tourName = $_POST['tourName'];
$tourPersons = $_POST['tourPersons'];
$tourPrice = $_POST['tourPrice']; // This is the selected price from the dropdown
$tourDescription = $_POST['tourDescription'];
$tourDuration = $_POST['tourDuration']; 

// Handle file upload
$tourImage = $_FILES['tourImage']['name'];
$tourImageTmp = $_FILES['tourImage']['tmp_name'];
$uploadDir = '../uploads/';
$uploadFile = $uploadDir . basename($tourImage);

$response = array(); 

if (move_uploaded_file($tourImageTmp, $uploadFile)) {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO tours (TourTypeID, TourName, tourdescription, Price, tourimages, numberperson, TourDuration) VALUES (?, ?, ?, ?, ?, ?, ?)");
      
    // binding the sql query parameters to avoid sql injection here
    $stmt->bind_param("issdsss", $tourTypeID, $tourName, $tourDescription, $tourPrice, $tourImage, $tourPersons, $tourDuration);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "New tour added successfully";
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
