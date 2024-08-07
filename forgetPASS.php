<?php

// Ensure correct usage of PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
include('./Database/connect.php');

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => '',
    'redirect' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $query = "SELECT ClientUserID FROM clientusers WHERE Email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userID = $user['ClientUserID'];

            $token = bin2hex(random_bytes(20));
            $expiry = date("Y-m-d H:i:s", strtotime('+1 seconds')); 

            $query = "INSERT INTO passwordreset (ClientUserID, token, expiry) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('iss', $userID, $token, $expiry);
                $stmt->execute();

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Mailer = "smtp";
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Port = 465;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Username = 'traveltour391@gmail.com';
                    $mail->Password = 'xmnokfwswxljhqky';

                    $mail->setFrom('traveltour391@gmail.com', 'Travel and Tour');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset Request';
                    $mail->Body = "Click the link to reset your password: <a href='http://localhost:3001/Resetpass.php?token=$token'>Reset Password</a>";

                    $mail->send();

                    $response['success'] = true;
                    $response['message'] = "Password reset link has been sent to $email.";
                    $response['redirect'] = './login.php';
                } catch (Exception $e) {
                    $response['message'] = "Mailer Error: " . $mail->ErrorInfo;
                }
            } else {
                $response['message'] = "Failed to prepare the password reset query.";
            }
        } else {
            $response['message'] = "No account found with that email address.";
        }

        $stmt->close();
    } else {
        $response['message'] = "Failed to prepare the email check query.";
    }

    $conn->close();
}

echo json_encode($response);
?>
