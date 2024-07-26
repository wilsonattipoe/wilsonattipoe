<?php
ob_start();
session_start();
include('./Database/connect.php');

$response = [
    'status' => 'ok',
    'success' => false,
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST["email"]);
    $submittedPassword = trim($_POST['password']);

    if (!empty($email) && !empty($submittedPassword)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $checkEmailQuery = "SELECT `ClientUserID`, `Username`, `Password`, `FullName`, `Email` FROM `ClientUsers` WHERE `Email`=?";
            $stmt = mysqli_prepare($conn, $checkEmailQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $numRows = mysqli_stmt_num_rows($stmt);

                if ($numRows > 0) {
                    mysqli_stmt_bind_result($stmt, $dbUserId, $dbUsername, $dbPassword, $fullName, $dbEmail);
                    mysqli_stmt_fetch($stmt);

                    if (password_verify($submittedPassword, $dbPassword)) {
                        $_SESSION['ClientUserID'] = $dbUserId;
                        $_SESSION['Username'] = $dbUsername;

                        $response = [
                            'success' => true,
                            'redirect' => '/index.php'
                        ];
                    } else {
                        $response = [
                            'status' => 'ok',
                            'success' => false,
                            'message' => "Password doesn't match"
                        ];
                    }
                } else {
                    $response = [
                        'status' => 'ok',
                        'success' => false,
                        'message' => "User not found"
                    ];
                }
                mysqli_stmt_close($stmt);
            } else {
                $response = [
                    'status' => 'ok',
                    'success' => false,
                    'message' => 'Database query error'
                ];
            }
        } else {
            $response = [
                'status' => 'ok',
                'success' => false,
                'message' => 'Invalid email format'
            ];
        }
    } else {
        $response = [
            'status' => 'ok',
            'success' => false,
            'message' => 'Email and password cannot be empty'
        ];
    }
    mysqli_close($conn);

    // Send the JSON response
    echo json_encode($response);
}
ob_end_flush();
