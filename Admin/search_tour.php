<?php
include('../Database/connect.php');

$searchTerm = $_POST['searchTerm'] ?? '';

// Fetch filtered tour data from the database
$sql = "SELECT TourID, TourTypeID, TourName, tourdescription, Price, tourimages, numberperson, TourDuration, `date` 
        FROM tours 
        WHERE TourName LIKE ? OR tourdescription LIKE ?";
$stmt = $conn->prepare($sql);
$searchTermWildcard = "%$searchTerm%";
$stmt->bind_param('ss', $searchTermWildcard, $searchTermWildcard);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

$conn->close();
echo json_encode($tours);
?>
