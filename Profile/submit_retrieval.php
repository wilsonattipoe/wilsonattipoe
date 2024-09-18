<?php
session_start();
include("./Database/connect.php");

if (isset($_POST['retrieveTourID']) && isset($_POST['retrievalReason'])) {
    $retrieveTourID = $_POST['retrieveTourID'];
    $retrievalReason = $_POST['retrievalReason'];
    $clientUserID = $_SESSION['ClientUserID'];

    $sql = "INSERT INTO retrievals (bookTour_ID, clientUserID, reason) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $retrieveTourID, $clientUserID, $retrievalReason);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }

    $stmt->close();
}
$conn->close();
?>
