<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require '../vendor/autoload.php'; 

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'traveltour391@gmail.com';
        $mail->Password = 'xmnokfwswxljhqky';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';

        // Recipients
        $mail->setFrom('traveltour391@gmail.com', 'Travel Tour');
        $mail->addAddress('traveltour391@gmail.com', 'Travel and Tour');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";

        $mail->send();
        $response['status'] = 'success';
        $response['message'] = 'Message has been sent';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    echo json_encode($response);
}
?>
