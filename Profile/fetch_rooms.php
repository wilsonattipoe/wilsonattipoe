<?php
include('../Profile/Database/connect.php');

$sql = "SELECT Room_id, Rooms_Name, RoomImage FROM room";
$result = $conn->query($sql);

$rooms = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}

$conn->close();

echo json_encode($rooms);
?>
