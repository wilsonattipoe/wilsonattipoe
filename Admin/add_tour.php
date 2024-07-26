<?php
session_start();

// Include database configuration
include('../Admin/Database/connect.php');


// Retrieve form data
$tourName = $_POST['tourName'];
$tourDuration = $_POST['tourduration'];
$tourPersons = $_POST['tourPersons'];
$tourPrice = $_POST['tourPrice'];
$tourDescription = $_POST['tourDescription'];

// Handle file upload
$tourImage = $_FILES['tourImage']['name'];
$tourImageTmp = $_FILES['tourImage']['tmp_name'];
$uploadDir = '../uploads/';
$uploadFile = $uploadDir . basename($tourImage);

if (move_uploaded_file($tourImageTmp, $uploadFile)) {
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO tours (TourName, TourDuration, NumberOfPersons, Price, Description, Image) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siidss", $tourName, $tourDuration, $tourPersons, $tourPrice, $tourDescription, $tourImage);

    if ($stmt->execute()) {
        echo "New tour added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Failed to upload image.";
}

$conn->close();
?>