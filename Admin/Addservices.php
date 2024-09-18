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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and handle potential missing fields
    $tourName = $_POST['tourName'] ?? null;
    $tourPersons = $_POST['numberperson'] ?? null; 
    $tourPrice = $_POST['tourPrice'] ?? null;
    $tourDescription = $_POST['tourDescription'] ?? null;
    $tourDuration = $_POST['tourDuration'] ?? null;
    $tourSite = $_POST['tourSite'] ?? null;
    $Tourstat = $_POST['tourstat'] ?? null;
    $tourtypes = $_POST['tourtpyes'] ?? null;

    // Ensure all required fields are set
    if (empty($tourName) || empty($tourDescription) || empty($tourPrice)) {
        $response['success'] = false;
        $response['message'] = "Missing required fields.";
        echo json_encode($response);
        exit;
    }

    // Check if the tour name already exists (check for duplicates)
    $checkQuery = "SELECT * FROM tourservices WHERE tourname = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $tourName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Duplicate found
        $response['success'] = false;
        $response['message'] = "Tour name already exists.";
        echo json_encode($response);
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();

    // Handle file upload
    $tourImage = $_FILES['tourImage']['name'];
    $tourImageTmp = $_FILES['tourImage']['tmp_name'];
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($tourImage);

    if (move_uploaded_file($tourImageTmp, $uploadFile)) {
        // Insert new tour service
        $stmt = $conn->prepare("INSERT INTO tourservices (tourname, description, Price, tourimages, create_at, adminusers, tourDuration, numberperson, tourtypes, tourstatus) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssdsiisii", $tourName, $tourDescription, $tourPrice, $tourImage, $adminusers, $tourDuration, $tourPersons, $tourtypes, $Tourstat);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "New tour service added successfully.";

            // Log the activity
            $action = "Added new tour service: " . $tourName;
            $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the IP address

            // Prepare and execute the SQL statement to insert the log
            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $tourName);

            $logStmt->execute();
            $logStmt->close();

        } else {
            $response['success'] = false;
            $response['message'] = "Failed to add new tour service: " . $stmt->error;
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
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request.";
    echo json_encode($response);
}
?>
