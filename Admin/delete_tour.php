<?php
// Include database connection
include('../Database/connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'tour_id' is set in the POST data
    if (isset($_POST['tour_id'])) {
        $tour_id = $_POST['tour_id'];
        $adminusers = isset($_SESSION['AdminUserID']) ? $_SESSION['AdminUserID'] : null; // Ensure AdminUserID is available

        // Prepare and execute the deletion query
        $stmt = $conn->prepare("DELETE FROM tours WHERE TourID = ?");
        $stmt->bind_param("i", $tour_id);

        if ($stmt->execute()) {
            $response = ['success' => true];
            $action = 'Deleted tour';
            $details = "Tour ID: $tour_id";

            // Log the successful deletion
            if ($adminusers !== null) {
                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
                $logStmt->execute();
                $logStmt->close();
            } else {
                // Handle case where adminusers is not set
                $response['success'] = false;
                $response['message'] = "Admin user ID not set. Unable to log activity.";
            }
        } else {
            $response = ['success' => false, 'message' => 'Failed to delete tour'];
            $action = 'Failed to delete tour';
            $details = "Tour ID: $tour_id, Error: " . $stmt->error;

            // Log the failure
            if ($adminusers !== null) {
                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
                $logStmt->execute();
                $logStmt->close();
            } else {
                // Handle case where adminusers is not set
                $response['success'] = false;
                $response['message'] = "Admin user ID not set. Unable to log activity.";
            }
        }

        $stmt->close();
    } else {
        $response = ['success' => false, 'message' => 'Tour ID not provided'];
        $action = 'Attempted to delete tour without ID';
        $details = 'Tour ID not provided';

        // Log the invalid attempt
        if ($adminusers !== null) {
            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        } else {
            // Handle case where adminusers is not set
            $response['success'] = false;
            $response['message'] = "Admin user ID not set. Unable to log activity.";
        }
    }

    $conn->close();
    echo json_encode($response);
}
?>
