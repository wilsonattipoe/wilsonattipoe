<?php
session_start();

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../Admin/Database/connect.php'); 

// Check if AdminUserID is set in the session
if (!isset($_SESSION['AdminUserID'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$adminusers = $_SESSION['AdminUserID'];
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and handle file upload
    if (isset($_FILES['RoomImage']) && $_FILES['RoomImage']['error'] == UPLOAD_ERR_OK) {
        $roomImage = $_FILES['RoomImage']['name'];
        $targetDir = "../uploads/"; // Define your upload directory
        $targetFile = $targetDir . basename($roomImage);

        // Ensure the directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES['RoomImage']['tmp_name'], $targetFile)) {
            $response['success'] = false;
            $response['message'] = "Failed to upload image.";
            echo json_encode($response);
            exit;
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Image upload error.";
        echo json_encode($response);
        exit;
    }

    // Sanitize and prepare the data
    $roomName = $conn->real_escape_string($_POST['RoomName']);
    $roomAmount = $conn->real_escape_string($_POST['roomAmount']);
    $bedQuantity = $conn->real_escape_string($_POST['bedquantity']);
    $bathroom = $conn->real_escape_string($_POST['bathroom']);
    $wifi = $conn->real_escape_string($_POST['wifi']);
    $roomDescription = $conn->real_escape_string($_POST['RoomDescription']);

    // Prepare and execute the SQL query
    $query = $conn->prepare("INSERT INTO room (Rooms_Name, RoomImage, roomamount, bedquantity, bathroom, wifi, description, created_at, adminusers) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)");

    // Bind parameters
    $query->bind_param("ssiiisss", $roomName, $roomImage, $roomAmount, $bedQuantity, $bathroom, $wifi, $roomDescription, $adminusers);

    // Execute the query and check for success
    if ($query->execute()) {
        $response['success'] = true;
        $response['message'] = "Room added successfully!";

        // Insert activity log
        $action = 'Added a new room';
        $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
        $details = "Room Name: $roomName, Amount: $roomAmount";

        $logQuery = $conn->prepare("INSERT INTO activitylogs (adminusers, action, action_time, ip_address, details) 
        VALUES (?, ?, NOW(), ?, ?)");
$logQuery->bind_param("isss", $adminusers, $action, $ip_address, $details);


        if (!$logQuery->execute()) {
            // If the logging fails, you might want to handle this separately
            error_log("Failed to log activity: " . $logQuery->error);
        }

        $logQuery->close();

    } else {
        $response['success'] = false;
        $response['message'] = "Error: " . $query->error;
    }

    // Close the statement and connection
    $query->close();
    $conn->close();

    // Return the JSON response
    echo json_encode($response);
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
    echo json_encode($response);
}
?>
