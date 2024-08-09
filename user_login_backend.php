<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database connection
include './Database/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Query ClientUsers table
        $query = "SELECT `ClientUserID`, `Password`, `RoleID`, `Username` FROM `ClientUsers` WHERE `Email`=?";
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
                    $_SESSION['ClientUserID'] = $userID;
                    $_SESSION['RoleID'] = $roleID;
                    $_SESSION['Username'] = $username;

                    // Redirect for Client Users
                    $redirect = './index.php';

                    $response = [
                        'status' => 'ok',
                        'success' => true,
                        'message' => 'Login successful',
                        'redirect' => $redirect
                    ];
                } else {
                    $response = [
                        'status' => 'ok',
                        'success' => false,
                        'message' => 'Incorrect password'
                    ];
                }
            } else {
                mysqli_stmt_close($stmt); 

                // Query AdminUsers table
                $query = "SELECT `AdminUserID`, `Password`, `RoleID`, `Username` FROM `Adminusers` WHERE `Email`=?";
                $stmt = mysqli_prepare($conn, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $userID, $hashedPassword, $roleID, $username);
                    mysqli_stmt_fetch($stmt);

                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        // AdminUsers authentication
                        if (password_verify($password, $hashedPassword)) {
                            $_SESSION['AdminUserID'] = $userID;
                            $_SESSION['RoleID'] = $roleID;
                            $_SESSION['Username'] = $username;

                            // Redirect based on RoleID for Admin Users
                            switch ($roleID) {
                                case 1: // Admin
                                    $redirect = './Admin/Adminindex.php';
                                    break;
                                case 2: // Supervisor
                                    $redirect = './Supervisor/Supervisorindex.php';
                                    break;
                                case 4: // Employee (if applicable)
                                    $redirect = './Employee/Employeeindex.php';
                                    break;
                                default:
                                    $redirect = './login.php'; // Handle unexpected RoleID
                                    break;
                            }

                            $response = [
                                'status' => 'ok',
                                'success' => true,
                                'message' => 'Login successful',
                                'redirect' => $redirect
                            ];
                        } else {
                            $response = [
                                'status' => 'ok',
                                'success' => false,
                                'message' => 'Incorrect password'
                            ];
                        }
                    } else {
                        $response = [
                            'status' => 'ok',
                            'success' => false,
                            'message' => 'Email not found'
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
            'message' => 'All fields are required'
        ];
    }

    mysqli_close($conn);

    // Send the JSON response
    echo json_encode($response);
}
?>
