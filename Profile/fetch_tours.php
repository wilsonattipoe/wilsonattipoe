<?php
include("./Database/connect.php");

$sql = "SELECT TourName, tourdescription, Price, tourimages, numberperson, TourDuration, `date` FROM tours";
$result = $conn->query($sql); 

// This function is fetching all details from the tour table that admin currently added to the front end
if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($tours);
?>