<?php
include("./Database/connect.php");

if (isset($_POST['bookingID']) && isset($_POST['action'])) {
    $bookingID = $_POST['bookingID'];
    $action = $_POST['action'];

    // Retrieve the corresponding ActionID for the action name
    $query = "SELECT `ActionID`, `ActionName` FROM `actions` WHERE = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $action);
    $stmt->execute();
    $stmt->bind_result($actionID);
    $stmt->fetch();
    $stmt->close();

    // Update the Action_id in booktours
    $updateQuery = "UPDATE booktours SET Action_id = ? WHERE bookTour_ID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('ii', $actionID, $bookingID);

    if ($updateStmt->execute()) {
        echo 'Action updated';
    } else {
        echo 'Error updating action: ' . $conn->error;
    }
    $updateStmt->close();
}

$conn->close();
?>
