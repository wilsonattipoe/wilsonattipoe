<?php
// Include database connection
include('../Database/connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $tour_id = $_POST['id'];
    $tour_name = $_POST['name'];
    $tour_duration = $_POST['duration'];
    $numberperson = $_POST['numberperson'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $adminusers = isset($_SESSION['AdminUserID']) ? $_SESSION['AdminUserID'] : null; // Ensure AdminUserID is available

    // Validate input data
    if (isset($tour_id) && !empty($tour_id)) {
        // Prepare the update query
        $stmt = $conn->prepare("UPDATE tours SET TourName = ?, TourDuration = ?, numberperson = ?, Price = ?, tourdescription = ? WHERE TourID = ?");
        $stmt->bind_param("ssidsi", $tour_name, $tour_duration, $numberperson, $price, $description, $tour_id);

        // Execute the query
        if ($stmt->execute()) {
            $response = ['success' => true];
            echo json_encode($response);

            // Log the successful update
            if ($adminusers !== null) {
                $action = 'Updated tour';
                $details = "Tour ID: $tour_id";

                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
                $logStmt->execute();
                $logStmt->close();
            }
        } else {
            $response = ['success' => false, 'message' => 'Failed to update tour'];
            echo json_encode($response);

            // Log the failure
            if ($adminusers !== null) {
                $action = 'Failed to update tour';
                $details = "Tour ID: $tour_id, Error: " . $stmt->error;

                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
                $logStmt->execute();
                $logStmt->close();
            }
        }

        $stmt->close();
    } else {
        $response = ['success' => false, 'message' => 'Tour ID not provided'];
        echo json_encode($response);
    }

    $conn->close();
}
?>
