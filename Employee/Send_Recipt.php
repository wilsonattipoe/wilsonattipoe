<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include header and FPDF library
require './fpdf/fpdf.php';
require './Database/connect.php';


ob_start();



            if ($stmt->num_rows > 0) {
                                // logs strat
                $stmt = $conn->prepare("INSERT INTO `logs_tbl`( `activity_dec`, `user_id`) VALUES (?,?)");
                $activityDescription = "made payment for ".$student_id;
                $stmt->bind_param("ss",  $activityDescription,$userId);
                $stmt->execute();
// logs enda

            if ($student_id) {
                $query = mysqli_query($conn, "SELECT 
                    p.student_id,
                    s.first_name,
                    s.last_name,
                    L.level_name,
                    Q.program_name,
                    A.AccademicYear,
                    U.user_name,
                    p.payment_date,
                    M.SetAmount,
                    G.payment_type,
                    s.phone_number,
                    CASE
                        WHEN M.SetAmount = M.SetAmount THEN 'Full payment of Dues' 
                        WHEN M.SetAmount > M.SetAmount THEN 'Being Part payment of Dues'
                        ELSE 'Credit'
                    END AS debt
                    FROM payment_tbl p
                    JOIN student_tbl s ON s.student_id = p.student_id
                    JOIN user_tbl U ON U.user_id = p.user_id
                    JOIN setamount_tbl M ON M.SetAmount_id = p.setamount_id
                    JOIN accademicyear_tbl A ON A.AccademicYear_id = M.academic_year_id
                    JOIN program_tbl Q ON s.program_id = Q.program_id
                    JOIN level_tbl L ON s.level_id = L.level_id
                    JOIN mode_payment_tbl G ON G.mode_payment_id = p.mode_payment_id
                WHERE s.student_id = '".$student_id."'");

            $userData = mysqli_fetch_assoc($query);

            if ($userData) {
            // Create a new PDF document
            $pdf = new FPDF();
            $pdf = new FPDF('P', 'mm', 'A4');
            // Set document information
            $pdf->SetTitle('TRAVEL&TOUR  INVOICE');

            // Add a page
            $pdf->AddPage();

            // Set font
            $pdf->SetFont('Arial','B',15);
            // Header of the Receipt
            $pdf->Image('../img/about-1.jpg', 10, 15, 15); 
            $pdf->SetFontSize(12);
            $pdf->Cell(0, 10, 'TRAVEL&TOUR  INVOICE', 0, 1, 'C');
            $pdf->SetFontSize(10); 
            $pdf->Cell(0, 10, 'OFFICIAL RECEIPT', 0, 5, 'C');
            $pdf->SetFontSize(8); 
            $pdf->Cell(0, 10, 'Customer Payment Receipt', 0, 5, 'C');
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

            // Add IST information on the left side
            $pdf->SetXY(10, $pdf->GetY()+10); 
            $pdf->SetFont('Arial','',10);
            // IST Information
            $pdf->Cell(0, 10, 'Transaction ref:Travel&Tour ', 0, 1, 'L');
            $pdf->Cell(0, 10, 'Student ID: ' . $userData['student_id'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Student Name: ' . $userData['first_name'] . ' ' . $userData['last_name'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Programme: ' . $userData['program_name'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Academic Year: ' . $userData['AccademicYear'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Level: ' . $userData['level_name'], 0, 1, 'L');

            // Add 2nd information on the right side
            $pdf->SetXY(100, $pdf->GetY()-60); 
            // 2nd Information
            $pdf->Cell(0, 10, 'Transaction date: ' . $userData['payment_date'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Amount paid: ' . $userData['SetAmount'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Payment type:' . $userData['payment_type'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Description: ' . $userData['debt'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Phone number: ' . $userData['phone_number'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Served by: ' . $userData['user_name'], 0, 1, 'R');


            // Draw dashed lines
            $pdf->SetLineWidth(0.2); 
            // Dummy space for receipt information
            $pdf->SetFontSize(6);
            $pdf->Cell(189 ,10,'',0,1);
            $pdf->Cell(0, 10, "Receipt issued on Trave and Tour mandate", 0, 1, 'C');
            $startX = 10;
            $endX = 200;
            $yPosition = $pdf->GetY() + 1; 
            for ($i = $startX; $i < $endX; $i += 4) {
                $pdf->Line($i, $yPosition, $i + 1, $yPosition);
            }



            //second Receipt below
            $pdf->Cell(189 ,10,'',0,1);

            // Set font
            $pdf->SetFont('Arial','B',15);
            // Header of the Receipt
            $pdf->Image('../Secretary/images/htu1.png', 10, 15, 15); 
            $pdf->SetFontSize(12);
            $pdf->Cell(0, 10, 'TRAVEL&TOUR  INVOICE', 0, 1, 'C');
            $pdf->SetFontSize(10); 
            $pdf->Cell(0, 10, 'OFFICIAL RECEIPT', 0, 5, 'C');
            $pdf->SetFontSize(8); 
            $pdf->Cell(0, 10, 'Customer Dues Reciept', 0, 5, 'C');
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());


            // Add IST information on the left side
            $pdf->SetXY(10, $pdf->GetY()+10); 
            $pdf->SetFont('Arial','',10);
            // IST Information
            $pdf->Cell(0, 10, 'Transaction ref: Travel&Tour ', 0, 1, 'L');
            $pdf->Cell(0, 10, 'Student ID: ' . $userData['student_id'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Student Name: ' . $userData['first_name'] . ' ' . $userData['last_name'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Programme: ' . $userData['program_name'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Academic Year: ' . $userData['AccademicYear'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Level: ' . $userData['level_name'], 0, 1, 'L');

            // Add 2nd information on the right side
            $pdf->SetXY(100, $pdf->GetY()-60); 
            // 2nd Information
            $pdf->Cell(0, 10, 'Transaction date: ' . $userData['payment_date'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Amount paid: ' . $userData['SetAmount'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Payment type:' .$userData['payment_type'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Description:' .$userData['debt'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Phone number: ' . $userData['phone_number'], 0, 1, 'R');
            $pdf->Cell(0, 10, 'Served by: ' . $userData['user_name'], 0, 1, 'R');


            // Draw dashed lines

            $pdf->SetLineWidth(0.2); 
            // Dummy space for receipt information
            $pdf->SetFontSize(6);
            $pdf->Cell(189 ,10,'',0,1);
            $pdf->Cell(0, 10, "Receipt issued on Travel and Tour mandate", 0, 1, 'C');
            $startX = 10;
            $endX = 200;
            $yPosition = $pdf->GetY() + 1; 
            for ($i = $startX; $i < $endX; $i += 4) {
                $pdf->Line($i, $yPosition, $i + 1, $yPosition);
            }

            $pdf->Cell(120 ,1,'',0,1);
                $pdf->Cell(0, 10, "1", 0, 1, 'C');


                ob_end_clean();
            // Output the PDF
            $pdf->Output();
            }
}
}else{
        ob_end_clean();
      displayMessage('Error', 'custmoer does not exit' , 'error');
    }























