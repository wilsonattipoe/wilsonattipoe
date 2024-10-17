<?php
session_start();
include("./Database/connect.php");

// Check if session variables are set
if (isset($_SESSION['ClientUserID'])) {
    $userID = $_SESSION['ClientUserID'];
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$type = $_GET['type']; // Check if 'type' parameter is passed (current or existing)

// Define SQL query based on the request type
if ($type === 'current') {
    $sql = "SELECT
      B.ClientUserID,
      T.TourName,
      TS.TourTypeName,
      B.bookPrice,
      B.participants,
      T.start_date,
      T.end_date,
      A.ActionName FROM `booktours` B
join tours T on B.tour_id = T.TourID
Join actions A on B.action_id = A.ActionID
Join tourtypes TS on T.tourtype_id = TS.TourTypeID
WHERE B.ClientUserID = ? AND A.ActionName = 'ongoing'";
} else if ($type === 'existing') {
    $sql = "SELECT
      B.ClientUserID,
      T.TourName,
      TS.TourTypeName,
      B.bookPrice,
      B.participants,
      T.start_date,
      T.end_date,
      A.ActionName FROM `booktours` B
join tours T on B.tour_id = T.TourID
Join actions A on B.action_id = A.ActionID
Join tourtypes TS on T.tourtype_id = TS.TourTypeID
WHERE B.ClientUserID = ? AND A.ActionName = 'old'";
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request type']);
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

echo json_encode(['status' => 'success', 'data' => $bookings]);

$stmt->close();
$conn->close();
