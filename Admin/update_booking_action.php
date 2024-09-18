<?php
include("./Database/connect.php");
session_start();

if (isset($_POST['bookingID']) && isset($_POST['action'])) {
    $bookingID = $_POST['bookingID'];
    $action = $_POST['action'];

    // Retrieve the corresponding ActionID for the action name
    $query = "SELECT `ActionID` FROM `actions` WHERE ActionName = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $action);
    $stmt->execute();
    $stmt->bind_result($actionID);
    $stmt->fetch();
    $stmt->close();

    $adminusers = isset($_SESSION['AdminUserID']) ? $_SESSION['AdminUserID'] : null; // Ensure AdminUserID is available

    // Update the Action_id in booktours
    $updateQuery = "UPDATE booktours SET Action_id = ? WHERE bookTour_ID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('ii', $actionID, $bookingID);

    if ($updateStmt->execute()) {
        echo 'Action updated';

        // Log the successful update
        if ($adminusers !== null) {
            $actionLog = 'Updated booking action';
            $details = "Booking ID: $bookingID, Action: $action";

            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $actionLog, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        }
    } else {
        echo 'Error updating action: ' . $conn->error;

        // Log the failure
        if ($adminusers !== null) {
            $actionLog = 'Failed to update booking action';
            $details = "Booking ID: $bookingID, Error: " . $conn->error;

            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $actionLog, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        }
    }
    $updateStmt->close();
    $conn->close();
}
?>
