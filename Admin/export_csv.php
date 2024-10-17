<?php
include('./Database/connect.php');

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="tour_customers.csv"');

$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, ['Client Name', 'Email', 'Location', 'Phone Number', 'Amount', 'Status', 'Date']);

// Fetch data from database
$sql = "SELECT 
            cu.FullName AS customerName,
            cu.Email AS customerEmail,
            cu.location AS customerLocation,
            cu.contact AS customerContact,
            bookPrice AS amount,
            bt.status AS status,
            bt.Dated AS bookingDate
        FROM 
            booktours bt
        JOIN 
            clientusers cu ON bt.ClientUserID = cu.ClientUserID";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['customerName'],
        $row['customerEmail'],
        $row['customerLocation'],
        $row['customerContact'],
        $row['amount'],
        $row['status'],
        $row['bookingDate']
    ]);
}

fclose($output);
$conn->close();
?>
