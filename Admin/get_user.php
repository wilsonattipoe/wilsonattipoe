<?php
include("./Database/connect.php");

// Check if the 'id' parameter is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare("SELECT adminusers.AdminUserID, adminusers.Username, adminusers.Email, roles.RoleName, roles.RoleID, adminstatus.statusName, adminstatus.statusID
                            FROM adminusers 
                            JOIN roles ON adminusers.RoleID = roles.RoleID 
                            JOIN adminstatus ON adminusers.statusID = adminstatus.statusID
                            WHERE adminusers.AdminUserID = ?");
    $stmt->bind_param("i", $id);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid or missing ID']);
}

mysqli_close($conn);
?>
