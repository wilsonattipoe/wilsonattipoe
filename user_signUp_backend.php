<?php
ob_start();
session_start();
include('./Database/connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST["userName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST['password']);
    $fullName = trim($_POST['fullName']);

    if (!empty($username) && !empty($email) && !empty($password) && !empty($fullName)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if email already exists
            $checkEmailQuery = "SELECT `ClientUserID` FROM `ClientUsers` WHERE `Email`=?";
            $stmt = mysqli_prepare($conn, $checkEmailQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $numRows = mysqli_stmt_num_rows($stmt);

                if ($numRows > 0) {
                    $response = [
                        'status' => 'ok',
                        'success' => false,
                        'message' => 'Email already registered'
                    ];
                } else {
                    mysqli_stmt_close($stmt);

                    // Insert the new user
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $insertUserQuery = "INSERT INTO `ClientUsers` (`Username`, `Password`, `FullName`, `Email`) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $insertUserQuery);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $username, $hashedPassword, $fullName, $email);
                        if (mysqli_stmt_execute($stmt)) {
                            $response = [
                                'status' => 'ok',
                                'success' => true,
                                'message' => 'User registered successfully'
                            ];
                        } else {
                            $response = [
                                'status' => 'ok',
                                'success' => false,
                                'message' => 'Error registering user'
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
                }
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
            'message' => 'All fields are required'
        ];
    }
    mysqli_close($conn);

    // Send the JSON response
    echo json_encode($response);
}
ob_end_flush();
?>
