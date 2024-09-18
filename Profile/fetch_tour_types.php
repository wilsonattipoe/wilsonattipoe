<?php
include("./Database/connect.php");

$query = "SELECT TourTypeID AS id, TourTypeName AS name FROM tourtypes";
$result = $conn->query($query);

$tourTypes = [];
while ($row = $result->fetch_assoc()) {
    $tourTypes[] = $row;
}

echo json_encode($tourTypes);

$conn->close();
?>
