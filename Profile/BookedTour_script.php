<?php
include("./Database/connect.php");

// Ensure $tourType is set correctly from the request, with a default value
$tourType = isset($_GET['type']) ? $_GET['type'] : 'special';

// Construct the SQL query based on the tour type
switch ($tourType) {
    case 'special':
        $sql = "SELECT TourName, tourdescription, Price, tourimages, numberperson, TourDuration FROM tours WHERE category = 'special'";
        break;
    case 'ongoing':
        $sql = "SELECT TourName, tourdescription, Price, tourimages, numberperson, TourDuration FROM tours WHERE category = 'ongoing'";
        break;
    case 'old':
        $sql = "SELECT TourName, tourdescription, Price, tourimages, numberperson, TourDuration FROM tours WHERE category = 'old'";
        break;
    default:
        $sql = "SELECT TourName, tourdescription, Price, tourimages, numberperson, TourDuration FROM tours WHERE category = 'special'";
        break;
}

// Execute the query
$result = $conn->query($sql);

// Fetch the results and return them as JSON
if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($tours);

// Close the database connection
$conn->close();
?>
