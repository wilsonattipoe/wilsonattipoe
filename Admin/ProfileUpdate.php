<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('./Database/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['AdminUserID'])) {
        $userId = $_SESSION['AdminUserID'];
        $userTable = 'Adminusers';
        $userIdColumn = 'AdminUserID';
    } elseif (isset($_SESSION['ClientUserID'])) {
        $userId = $_SESSION['ClientUserID'];
        $userTable = 'ClientUsers';
        $userIdColumn = 'ClientUserID';
    } else {
        die("User not logged in");
    }

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $adminusers = isset($_SESSION['AdminUserID']) ? $_SESSION['AdminUserID'] : null; // Ensure AdminUserID is available

    // Prepare the update query
    $query = "UPDATE $userTable SET Username=?, Email=?";
    if (!empty($password)) {
        // Update password if it's provided
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", Password=?";
    }
    $query .= " WHERE $userIdColumn=?";

    $stmt = $conn->prepare($query);

    if (!empty($password)) {
        $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);
    } else {
        $stmt->bind_param("ssi", $username, $email, $userId);
    }

    if ($stmt->execute()) {
        $response = [
            'status' => 'ok',
            'success' => true,
            'message' => 'Profile updated successfully'
        ];

        // Log the successful update
        if ($adminusers !== null) {
            $action = 'Updated profile';
            $details = "User ID: $userId";

            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        }
    } else {
        $response = [
            'status' => 'ok',
            'success' => false,
            'message' => 'Failed to update profile'
        ];

        // Log the failure
        if ($adminusers !== null) {
            $action = 'Failed to update profile';
            $details = "User ID: $userId, Error: " . $stmt->error;

            $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, ?, ?, NOW(), ?, ?)");
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $logStmt->bind_param("ssss", $adminusers, $action, $ipAddress, $details);
            $logStmt->execute();
            $logStmt->close();
        }
    }
    $stmt->close();
    $conn->close();

    // Send JSON response
    echo json_encode($response);
}
?>
