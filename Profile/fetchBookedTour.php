<?php
include("./Database/connect.php");

$userId = $_POST['userId'];
// Prepare the query with a placeholder
$sql = "SELECT C.FullName,T.TourName,R.Rooms_Name,T.tourimages,B.participants,T.Price,T.tourdescription,T.start_date,t.end_date FROM `booktours` B
join tours T on B.tour_id = T.TourID
join room R on B.room_id = R.Room_id
join clientusers C on B.ClientUserID = C.ClientUserID
WHERE C.ClientUserID = ?"; // Placeholder for dynamic binding

// Initialize statement
$stmt = $conn->prepare($sql);

// Bind the parameter (replace 10 with your desired tourtype_id)
$ClientUserID = $userId; // Example dynamic value
$stmt->bind_param("i", $ClientUserID);  // 'i' denotes integer type

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the data
$tours = [];
if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($tours);
