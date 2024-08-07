<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./Database/connect.php'); 

$response = array();

if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tourName = $_POST['tourName'];
    $date = $_POST['date'];
    $userID = $_SESSION['ClientUserID'];

    // Fetch the ActionID for 'pending'
    $actionSql = "SELECT ActionID FROM Actions WHERE ActionName = 'pending'";
    $actionResult = $conn->query($actionSql);
    if ($actionResult->num_rows > 0) {
        $actionRow = $actionResult->fetch_assoc();
        $actionID = $actionRow['ActionID'];

        // Check if a similar request already exists
        $checkSql = "SELECT * FROM request WHERE ClientUserID = ? AND Request_title = ? AND Request_description = ? AND Request_tourname = ? AND Request_Date = ?";
        $checkStmt = $conn->prepare($checkSql);
        if ($checkStmt === false) {
            $response['success'] = false;
            $response['error'] = 'Prepare failed: ' . $conn->error;
            echo json_encode($response);
            exit();
        }
        $checkStmt->bind_param('issss', $userID, $title, $description, $tourName, $date);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            // Similar request already exists
            $response['success'] = false;
            $response['error'] = 'A similar request already exists.';
        } else {
            // Prepare SQL query to insert data into the request table with status 'pending'
            $sql = "INSERT INTO request (ClientUserID, Request_title, Request_description, Request_tourname, Request_Date, ActionID) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                $response['success'] = false;
                $response['error'] = 'Prepare failed: ' . $conn->error;
                echo json_encode($response);
                exit();
            }
            $stmt->bind_param('issssi', $userID, $title, $description, $tourName, $date, $actionID);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['error'] = $stmt->error;
            }
            $stmt->close();
        }
        $checkStmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Action status "pending" not found.';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Session not set.';
}

echo json_encode($response);
?>
