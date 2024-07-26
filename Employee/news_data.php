
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

// Database connection code
require_once('../Employee/Database/config.php');

$response = [
    'status' => 'ok',
    'success' => false,
    'message' => '',
];



if (isset($_POST['subject'])) {
    
    $userId = $_POST["userId"];
    $username = $_POST['username'];

    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($subject) || empty($message)) {
        $response = [
            'status' => 'ok',
            'success' => false,
            'message' => 'Subject and message are required!',
        ];
    
    }elseif(trim(empty($subject))){ $response = [
            'status' => 'ok',
            'success' => false,
            'message' => 'Subject are required!',
        ];
    }elseif(trim(empty($subject))){ $response = [
            'status' => 'ok',
            'success' => false,
            'message' => 'message are required!',
        ];
    }else {
        try {
            // Initialize PHPMailer
            $mail = new PHPMailer(true);

            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'traveltour391@gmail.com';
            $mail->Password = 'fuhy pyhc jnli dqks';
            $mail->Port = 587;
            $mail->FromName = "Trave&Tour";
            $mail->SMTPSecure = 'tls';

            // Set 'From' email address
            $mail->setFrom('traveltour391@gmail.com');

            // Retrieve student emails from the database
            $sql = "SELECT Email FROM student_tbl";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $emails = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($emails as $email) {
                $recipient = $email['Email'];
                $mail->addBCC($recipient);
            }

                // Set subject and body of the email
                $mail->Subject = $subject;
                $mail->Body = $message;

                // Insert email-related data into the database
                $stmt = $conn->prepare("INSERT INTO `new`(`new_subject`, `news`, `user_id`) VALUES (?,?,?)");
                $stmt->bind_param("sss", $subject, $message, $userId);
                $stmt->execute();

                // Send the email
                $mail->send();

                // Log activity
                logActivity($conn, "sent an Email", $userId);

                $response = [
                    'status' => 'ok',
                    'success' => true,
                    'message' => 'Mail sent successfully!',
                ];
            } else {
                $response = [
                    'status' => 'ok',
                    'success' => false,
                    'message' => 'No student emails found!',
                ];
            }
        } catch (Exception $e) {
            // Log exception for debugging
            logActivity($conn, 'Error sending email: ' . $e->getMessage(), $userId);

            $response = [
                'status' => 'ok',
                'success' => false,
                'message' => 'An error occurred while processing your request. Please try again later.',
            ];
        }
    }

    // Clear sensitive information
    $mail->clearAddresses();
}

// Close the database connection
mysqli_close($conn);

// Send the JSON response
echo json_encode($response);

// Function to log activity
function logActivity($conn, $activityDescription, $userId) {
    $stmt = $conn->prepare("INSERT INTO `logs_tbl`(`activity_dec`, `user_id`) VALUES (?,?)");
    $stmt->bind_param("ss", $activityDescription, $userId);
    $stmt->execute();
}
?>
