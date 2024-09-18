<?php
include("./Database/connect.php");

// Query to fetch recent bookings with user details and tour type
$sql = "SELECT 
            cu.FullName AS customerName,
            cu.contact AS customerContact,
            bt.price AS amount,
            tt.TourTypeName AS tourType
        FROM 
            booktours bt
        JOIN 
            clientusers cu ON bt.ClientUserID = cu.ClientUserID
        JOIN
            tourtypes tt ON bt.tourType_id = tt.TourTypeID
        ORDER BY 
            bt.Dated DESC
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
?>
