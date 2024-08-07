<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

require '../vendor/autoload.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];

    // Database connection code
    require_once('../Admin/Database/connect.php');

    // Fetch users from database
    $sql = "SELECT `ClientUserID`, `FullName`, `Email` FROM `clientusers` WHERE 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $email = $row['Email'];
            $fullName = $row['FullName'];

            // Prepare email
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'traveltour391@gmail.com';
                $mail->Password = 'xmnokfwswxljhqky';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                // Recipients
                $mail->setFrom('traveltour391@gmail.com', 'Travel and Tour'); 
                $mail->addAddress($email, $fullName);

                // Content
                $mail->isHTML(true);
                $mail->Subject = "Tour Announcement";
                $mail->Body = "Dear $fullName,<br><br>$message";
                $mail->send();
               
            } catch (Exception $e) {
                $errorCount++;
            }
        }
        echo "Emails sent successfully";
    } else {
        echo "No users found in the database.";
    }

    $conn->close();
}
?>
