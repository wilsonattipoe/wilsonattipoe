<?php
include("./Database/connect.php");

// Query to fetch tour customers' details
$sql = "SELECT`FullName`, `Email`, `contact`, `location` FROM `clientusers`";

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
?>
