<?php
include("./Database/connect.php");

$userID = $_GET['userID']; // Ensure userID is being passed correctly

// Validate userID
if (!filter_var($userID, FILTER_VALIDATE_INT)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid user ID.']);
    exit();
}

// Prepare the query with a placeholder for ClientUserID
$sql = "
    SELECT 
    `ClientUserID`,
        `participants`,
        T.TourID, 
        T.tourdescription, 
        T.TourName,
        T.tourimages, 
        T.start_date,
        W.TourTypeName,
        T.TourDuration,
        T.end_date,
        `bookPrice` FROM `booktours` B 
        JOIN tours T on B.tour_id = T.TourID
        JOIN tourtypes W ON T.tourtype_id = W.TourTypeID
    WHERE B.ClientUserID = ?
";

// Initialize statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Handle SQL preparation error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'SQL Prepare failed: ' . $conn->error]);
    exit();
}

// Bind the parameter (i.e., userID passed from the request)
$stmt->bind_param("i", $userID); // 'i' denotes integer type

// Execute the query
if (!$stmt->execute()) {
    // Handle execution error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Query execution failed: ' . $stmt->error]);
    exit();
}

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
