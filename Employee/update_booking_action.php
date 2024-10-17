<?php
include("./Database/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingID = $_POST['bookingID'];
    $action = $_POST['action'];

    // Mapping action to ActionID (assumes 'pending' -> 1, 'ongoing' -> 2, 'rejected' -> 3)
    $actionIDMap = [
        'pending' => 1,
        'ongoing' => 2,
        'rejected' => 3
    ];

    if (isset($actionIDMap[$action])) {
        $actionID = $actionIDMap[$action];
        $sql = "UPDATE booktours SET action_id = ? WHERE bookTour_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $actionID, $bookingID);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating status']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
