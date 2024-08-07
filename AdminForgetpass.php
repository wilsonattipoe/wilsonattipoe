<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./include/header.php');

// Ensure correct usage of PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

include('./Database/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    // Check if the email is empty
    if (empty($email)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            Swal.fire({
                title: "Error!",
                text: "Please enter an email address.",
                icon: "error",
                confirmButtonText: "Okay"
            });
        </script>';
        exit;
    }

    // Check if the email exists in the database
    $query = "SELECT AdminUserID FROM adminusers WHERE Email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userID = $user['AdminUserID'];

            $token = bin2hex(random_bytes(20));  
            $expiry = date("Y-m-d H:i:s", strtotime('+1 minutes'));

            // Insert the token into the passwordreset table
            $query = "INSERT INTO passwordreset (AdminUserID, token, expiry) VALUES (?, ?, ?)";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('iss', $userID, $token, $expiry);
                $stmt->execute();

                // Send email with the reset link
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
                    $mail->Body    = "Click the link to reset your password: <a href='http://localhost:3001/reset_password.php?token=$token'>Reset Password</a>";

                    $mail->send();

                    // Success alert
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                    echo '<script>
                        Swal.fire({
                            title: "Success!",
                            text: "Password reset link has been sent to ' . $email . '.",
                            icon: "success",
                            confirmButtonText: "Okay"
                        }).then(() => {
                            window.location.href = "./login.php"; // Replace with actual redirect URL
                        });
                    </script>';
                } catch (Exception $e) {
                    // Error alert
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                    echo '<script>
                        Swal.fire({
                            title: "Error!",
                            text: "Mailer Error: ' . $mail->ErrorInfo . '",
                            icon: "error",
                            confirmButtonText: "Okay"
                        });
                    </script>';
                }
            } else {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to prepare the password reset query.",
                        icon: "error",
                        confirmButtonText: "Okay"
                    });
                </script>';
                exit;
            }
        } else {
            // Email does not exist
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "No account found with that email address.",
                    icon: "error",
                    confirmButtonText: "Okay"
                });
            </script>';
        }

        $stmt->close();
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            Swal.fire({
                title: "Error!",
                text: "Failed to prepare the email check query.",
                icon: "error",
                confirmButtonText: "Okay"
            });
        </script>';
    }

    $conn->close();
}
?>




<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="./img/forget.jpg" style="height: 100%; width:100%;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" id="resetPasswordForm" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div><br>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Reset Password">
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
            var email = document.getElementById('exampleInputEmail').value;

            if (!email) {
                event.preventDefault(); 
                Swal.fire({
                    title: 'Error!',
                    text: 'Please enter an email address.',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            }
        });
    </script>
</body>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
