<?php
include('./Database/connect.php');

require('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$pdf->Cell(0, 10, 'Tour Customers', 0, 1, 'C');

// Set table header
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(40, 10, 'Client Name', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Email', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Location', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Phone Number', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Amount', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Status', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Date', 1, 1, 'C', 1);

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
    $pdf->Cell(40, 10, $row['customerName'], 1);
    $pdf->Cell(40, 10, $row['customerEmail'], 1);
    $pdf->Cell(40, 10, $row['customerLocation'], 1);
    $pdf->Cell(30, 10, $row['customerContact'], 1);
    $pdf->Cell(30, 10, $row['amount'], 1);
    $pdf->Cell(30, 10, $row['status'], 1);
    $pdf->Cell(30, 10, $row['bookingDate'], 1);
    $pdf->Ln();
}

$pdf->Output('tour_customers.pdf', 'D');
$conn->close();
?>
