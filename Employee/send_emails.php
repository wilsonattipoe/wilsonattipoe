<?php
include('./Database/connect.php'); // Adjust the path if needed

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

require '../vendor/autoload.php'; 
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Update with your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'traveltour391@gmail.com';
    $mail->Password   = 'xmnokfwswxljhqky';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use PHPMailer::ENCRYPTION_STARTTLS for TLS
    $mail->Port       = 465; // Use 587 for TLS

    // Capture and validate POST parameters
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : null;
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

    // Log incoming POST data
    error_log('Email: ' . $email);
    error_log('ID: ' . $id);

    if (!$email || !$id) {
        // Log error and exit
        error_log('Error: Email or ID not provided');
        $details = 'Email or ID not provided';
        $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, NULL, 'Email or ID not provided', NOW(), ?, ?)");
        $logStmt->bind_param("ss", $_SERVER['REMOTE_ADDR'], $details);
        $logStmt->execute();
        $logStmt->close();
        echo json_encode(['status' => 'error', 'message' => 'Email or ID not provided']);
        exit;
    }

    // Fetch client and booking details
    $query = "SELECT 
    cu.Email AS client_email,
    cu.FullName AS client_name,
    tt.TourTypeName AS tour_type_name, 
    ts.site_name AS tour_site_name, 
    bt.price, 
    bt.Dated, 
    a.ActionName AS action_status 
FROM booktours bt
LEFT JOIN clientusers cu ON bt.ClientUserID = cu.ClientUserID
LEFT JOIN tourtypes tt ON bt.tourType_id = tt.TourTypeID
LEFT JOIN tourist_sites ts ON bt.tourSite_id = ts.site_id
LEFT JOIN actions a ON bt.Action_id = a.ActionID
WHERE cu.Email = ? AND bt.bookTour_ID = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Setup email
            $mail->clearAddresses();
            $mail->setFrom('traveltour391@gmail.com', 'Travel and Tour');
            $mail->addAddress($row['client_email'], $row['client_name']);
            
            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Confirmation';
            $mail->Body    = "<p>Dear {$row['client_name']},</p>
                              <p>Thank you for booking with us!</p>
                              <p>Tour Type: {$row['tour_type_name']}</p>
                              <p>Tour Site: {$row['tour_site_name']}</p>
                              <p>Amount: \${$row['price']}</p>
                              <p>Booking Date: {$row['Dated']}</p>
                              <p>Status: {$row['action_status']}</p>
                              <p>We look forward to serving you.</p>
                              <p>Best regards,<br>Tour Booking Team</p>";

            // Send email
            try {
                $mail->send();
                // Log success
                error_log('Email sent to: ' . $row['client_email']);
                $details = 'Emails sent successfully to: ' . $row['client_email'];
                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, NULL, 'Emails sent successfully', NOW(), ?, ?)");
                $logStmt->bind_param("ss", $_SERVER['REMOTE_ADDR'], $details);
                $logStmt->execute();
                $logStmt->close();
            } catch (Exception $e) {
                // Log mailer error
                error_log('Mailer Error: ' . $mail->ErrorInfo);
                $details = 'Mailer Error: ' . $mail->ErrorInfo;
                $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, NULL, 'Mailer Error', NOW(), ?, ?)");
                $logStmt->bind_param("ss", $_SERVER['REMOTE_ADDR'], $details);
                $logStmt->execute();
                $logStmt->close();
            }
        }
        echo json_encode(['status' => 'success']);
    } else {
        // Log no bookings found
        error_log('No bookings found for email: ' . $email);
        $details = 'No bookings found for email: ' . $email;
        $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, NULL, 'No bookings found', NOW(), ?, ?)");
        $logStmt->bind_param("ss", $_SERVER['REMOTE_ADDR'], $details);
        $logStmt->execute();
        $logStmt->close();
        echo json_encode(['status' => 'error', 'message' => 'No bookings found']);
    }
} catch (Exception $e) {
    // Log exception
    error_log('Exception caught: ' . $e->getMessage());
    $details = 'Exception caught: ' . $e->getMessage();
    $logStmt = $conn->prepare("INSERT INTO activitylogs (clientusers, adminusers, action, action_time, ip_address, details) VALUES (NULL, NULL, 'Exception caught', NOW(), ?, ?)");
    $logStmt->bind_param("ss", $_SERVER['REMOTE_ADDR'], $details);
    $logStmt->execute();
    $logStmt->close();
    echo json_encode(['status' => 'error', 'message' => 'Exception caught: ' . $e->getMessage()]);
}

// Close the connection
$conn->close();
?>
