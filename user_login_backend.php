<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
// Database connection
include './Database/connect.php';

$response = [
    'status' => 'ok',
    'success' => false,
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Query ClientUsers table
        $query = "SELECT `ClientUserID`, `Password`, `RoleID`, `Username` FROM `clientusers` WHERE `Email`=?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $userID, $hashedPassword, $roleID, $username);
            mysqli_stmt_fetch($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                // ClientUsers authentication
                if (password_verify($password, $hashedPassword)) {
                    session_regenerate_id(true); // Regenerate session ID to prevent session fixation attacks
                    $_SESSION['ClientUserID'] = $userID;
                    $_SESSION['RoleID'] = $roleID;
                    $_SESSION['Username'] = $username;

                    // Redirect for Client Users
                    $response = [
                        'status' => 'ok',
                        'success' => true,
                        'message' => 'Login successful',
                        'redirect' => './index.php'
                    ];
                } else {
                    $response['message'] = 'Invalid email or password';
                }
            } else {
                mysqli_stmt_close($stmt);

                // Query AdminUsers table
                $query = "SELECT `AdminUserID`, `Password`, `RoleID`, `statusID`, `Username` FROM `adminusers` WHERE `Email`=?";
                $stmt = mysqli_prepare($conn, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $userID, $hashedPassword, $roleID, $statusID, $username);
                    mysqli_stmt_fetch($stmt);

                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        // Check status before authentication
                        if ($statusID == 1) { // Active
                            if (password_verify($password, $hashedPassword)) {
                                session_regenerate_id(true); // Regenerate session ID to prevent session fixation attacks
                                $_SESSION['AdminUserID'] = $userID;
                                $_SESSION['RoleID'] = $roleID;
                                $_SESSION['Username'] = $username;
                                $_SESSION['statusID'] = $statusID; 

                                // Redirect based on RoleID for Admin Users
                                switch ($roleID) {
                                    case 1: // Admin
                                        $redirect = './Admin/Adminindex.php';
                                        break;
                                    case 2: // Supervisor
                                        $redirect = './Supervisor/Supervisorindex.php';
                                        break;
                                    case 4: // Employee 
                                        $redirect = './Employee/Employeeindex.php';
                                        break;
                                    default:
                                        $redirect = './login.php'; 
                                        break;
                                }

                                $response = [
                                    'status' => 'ok',
                                    'success' => true,
                                    'message' => 'Login successful',
                                    'redirect' => $redirect
                                ];
                            } else {
                                $response['message'] = 'Invalid email or password';
                            }
                        } elseif ($statusID == 2) { // Terminate
                            $response['message'] = 'Your account has been terminated. You can no longer access the system.';
                        } elseif ($statusID == 3) { // Non-Active
                            $response['message'] = 'Your account is not active. Please contact the admin for access.';
                        }
                    } else {
                        $response['message'] = 'Invalid email or password';
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $response['message'] = 'Database query error';
                }
            }
        } else {
            $response['message'] = 'Database query error';
        }
    } else {
        $response['message'] = 'All fields are required';
    }

    mysqli_close($conn);
    ob_end_clean();
    // Send the JSON response
    echo json_encode($response);
}
?>
