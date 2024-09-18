<?php
include("./Database/connect.php");
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roleID = $_POST['roleID'];
    $statusID = $_POST['statusID'];

    $adminusers = isset($_SESSION['AdminUserID']) ? $_SESSION['AdminUserID'] : null; // Ensure AdminUserID is available

    if (empty($id)) {
        echo json_encode(["error" => "Invalid or missing ID"]);
        exit;
    }

    // Prepare the update query to prevent SQL injection
    $stmt = $conn->prepare("UPDATE adminusers SET Username=?, Email=?, RoleID=?, statusID=? WHERE AdminUserID=?");
    $stmt->bind_param("ssiii", $name, $email, $roleID, $statusID, $id);

    // Execute the query
    if ($stmt->execute()) {
        echo 'User updated successfully';

        // Log the successful update
        if ($adminusers !== null) {
            $action = 'Updated admin user with role and status';
            $details = "User ID: $id";

            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        }
    } else {
        echo json_encode(["error" => $stmt->error]);

        // Log the failure
        if ($adminusers !== null) {
            $action = 'Failed to update admin user with role and status';
            $details = "User ID: $id, Error: " . $stmt->error;

            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        }
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid or missing ID"]);
}

mysqli_close($conn);
?>
