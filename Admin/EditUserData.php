<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./Database/connect.php");

// Get POST data
$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$roleID = $_POST['roleID'] ?? null;
$status = $_POST['status'] ?? null;


// Validate input
if (empty($id) || empty($name) || empty($email) || empty($roleID) || empty($status)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Prepare SQL query for updating adminuser and joining user_roles table
$sql = "UPDATE adminusers
        JOIN user_roles ON adminusers.RoleID = user_roles.RoleID
        SET adminusers.Username = ?, adminusers.Email = ?, adminusers.status = ?
        WHERE adminusers.AdminUserID = ? AND user_roles.RoleID = ?";

// Prepare and execute statement
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ssisi", $name, $email, $status, $id, $roleID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
}

// Close connection
$conn->close();
?>
