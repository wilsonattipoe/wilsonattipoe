<?php
include("./Database/connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'id' is set in the POST data
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $adminusers = isset($_SESSION['AdminUserID']) ? $_SESSION['AdminUserID'] : null; // Ensure AdminUserID is available

        // Prepare and execute the deletion query
        $stmt = $conn->prepare("DELETE FROM adminusers WHERE AdminUserID = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo 'User deleted successfully';

            // Log the successful deletion
            if ($adminusers !== null) {
                $action = 'Deleted user';
                $details = "User ID: $id";

                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
                $logStmt->execute();
                $logStmt->close();
            }
        } else {
            echo 'Error: ' . mysqli_error($conn);
            
            // Log the failure
            if ($adminusers !== null) {
                $action = 'Failed to delete user';
                $details = "User ID: $id, Error: " . $stmt->error;

                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
                $logStmt->execute();
                $logStmt->close();
            }
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'User ID not provided']);
    }

    $conn->close();
}
?>
