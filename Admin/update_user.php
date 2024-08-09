<?php
include("./Database/connect.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roleID = $_POST['roleID'];
    $statusID = $_POST['statusID'];

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
    } else {
        echo json_encode(["error" => $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid or missing ID"]);
}

mysqli_close($conn);
?>
