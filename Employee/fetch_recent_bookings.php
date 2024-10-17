<?php
include("./Database/connect.php");

// Query to fetch recent bookings with user details and tour type
$sql = "SELECT B.bookTour_ID, C.Username, T.TourName, bookPrice, S.TourTypeName, B.participants, 
                 (T.numberperson - B.participants) as total_left, A.ActionName, T.end_date, T.start_date 
          FROM `booktours` B
          JOIN tours T ON B.tour_id = T.TourID
          JOIN clientusers C ON B.ClientUserID = C.ClientUserID
          JOIN tourtypes S ON T.tourtype_id = S.TourTypeID
          JOIN actions A ON B.action_id = A.ActionID
                ORDER BY 
            B.Dated DESC
        LIMIT 5";


$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

echo json_encode($bookings);
$stmt->close();
$conn->close();
