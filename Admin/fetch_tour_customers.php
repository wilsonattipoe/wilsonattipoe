<?php
include("./Database/connect.php");

// Query to fetch tour customers' details
$sql = "SELECT 
            cu.FullName AS customerName,
            cu.Email AS customerEmail,
            cu.location AS customerLocation,
            cu.contact AS customerContact,
            bt.price AS amount,
            a.ActionName AS status,
            bt.Dated AS bookingDate
        FROM 
            booktours bt
        JOIN 
            clientusers cu ON bt.ClientUserID = cu.ClientUserID
        JOIN
            actions a ON bt.Action_id = a.ActionID
        ORDER BY 
            bt.Dated DESC";

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
