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

include("./Database/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Name"])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST["Name"]));
    $email = trim($_POST["Email"]);
    $password = bin2hex(random_bytes(6));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $position_id = mysqli_real_escape_string($conn, $_POST["Position"]);
    $Status = mysqli_real_escape_string($conn, $_POST["status"]);

    // Validate username for consecutive spaces
    if (preg_match('/\s{2,}/', $username)) {
        $response = [
            'status' => 'error',
            'message' => 'Username cannot contain consecutive spaces.'
        ];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($username) || empty($email) || empty($position_id) || empty($Status)) {
        $response = [
            'status' => 'error',
            'message' => 'Invalid or missing input. Please fill in all required fields.'
        ];
    } else {
        $checkUserQuery = "SELECT `Username`, `Email` FROM `adminusers` WHERE `Username`=? OR `Email`=?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response = [
                'status' => 'error',
                'message' => 'User with the same username or email already exists.'
            ];
        } else {
            $insertQuery = "INSERT INTO `adminusers`(`RoleID`, `statusID`, `Username`, `Password`, `Email`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("iisss", $position_id, $Status, $username, $hashedPassword, $email);

            if ($stmt->execute()) {
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'traveltour391@gmail.com';
                    $mail->Password = 'xmnokfwswxljhqky';
                    $mail->Port = 465;
                    $mail->SMTPSecure = 'ssl';
                    $mail->setFrom('traveltour391@gmail.com', 'Travel Tour');
                    $mail->addAddress($email);
                    $mail->Subject = 'Temporary Password';
                    $mail->Body = "Hello $username,\n\nYour login details are as follows:\n\nEmail: $email\nTemporary Password: $password\n\nPlease log in and change your password as soon as possible.";

                    if ($mail->send()) {
                        $response = [
                            'status' => 'ok',
                            'success' => true,
                            'message' => 'Record created successfully! You just received a temporary password.',
                            'redirect' => '../Addstaff.php'
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Error sending the email: ' . $mail->ErrorInfo
                        ];
                    }
                } catch (Exception $e) {
                    $response = [
                        'status' => 'error',
                        'message' => 'Mailer Error: ' . $mail->ErrorInfo
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Failed to add staff. Please try again later.'
                ];
            }

            $stmt->close();
        }
    }

    echo json_encode($response);
}
?>
