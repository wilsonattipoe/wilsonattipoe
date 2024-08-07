<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

require './vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Database connection code
    require_once('./Database/connect.php');

    // Save the message to the database along with the user's full name
    $stmt = $conn->prepare("INSERT INTO `email` (`email_text`, `FullName`) VALUES (?, ?)");
    $stmt->bind_param("ss", $message, $name);

    if ($stmt->execute()) {
        // Prepare email to be sent to the system administrator
        $adminEmail = 'traveltour391@gmail.com';
        $adminName = 'System Admin'; 

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
            $mail->setFrom($email, $name);
            $mail->addAddress($adminEmail, $adminName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "Name: $name<br>Email: $email<br><br>$message";

            $mail->send();
            echo "Your message has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to save message to the database.";
    }

    $stmt->close();
    $conn->close();
}
?>
