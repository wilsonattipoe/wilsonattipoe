<?php
session_start();
include("./Database/connect.php");

if (isset($_POST['cancelTourID']) && isset($_POST['cancellationReason'])) {
    $cancelTourID = $_POST['cancelTourID'];
    $cancellationReason = $_POST['cancellationReason'];
    $clientUserID = $_SESSION['ClientUserID'];

    // Validate that cancelTourID is not empty
    if (empty($cancelTourID)) {
        echo json_encode(['status' => 'error', 'message' => 'Booking ID cannot be empty.']);
        exit();
    }

    // Check if the booking exists
    $checkBooking = $conn->prepare("SELECT COUNT(*) FROM booktours WHERE bookTour_ID = ?");
    $checkBooking->bind_param("i", $cancelTourID);
    $checkBooking->execute();
    $checkBooking->bind_result($exists);
    $checkBooking->fetch();
    $checkBooking->close();

    if ($exists > 0) {
        // Insert the cancellation
        $sql = "INSERT INTO cancellations (bookTour_ID, clientUserID, reason) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $cancelTourID, $clientUserID, $cancellationReason);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Booking ID does not exist.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
}

$conn->close();
?>
