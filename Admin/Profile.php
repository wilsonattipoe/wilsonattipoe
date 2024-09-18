<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('include/header.php');
include('include/navbar.php');
// Include database connection
include('./Database/connect.php');

// Determine user ID from session
if (isset($_SESSION['AdminUserID'])) {
    $userId = $_SESSION['AdminUserID'];
} elseif (isset($_SESSION['ClientUserID'])) {
    $userId = $_SESSION['ClientUserID'];
} else {
    die("User not logged in");
}

// Fetch the user's profile details based on the user ID
$userQuery = "SELECT Username, Email FROM " . (isset($_SESSION['AdminUserID']) ? "Adminusers" : "ClientUsers") . " WHERE " . (isset($_SESSION['AdminUserID']) ? "AdminUserID" : "ClientUserID") . " = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// Ensure variables are not null
$username = $username ?? 'Not Available';
$email = $email ?? 'Not Available';
?>

<div class="container" style="margin-top:80px;" id="profile">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 col-md-4">
            <div class="card shadow">
                <div class="card-body" style="justify-content:center;">
                    <div class="text-center">
                        <h1 class="text-center">Profile</h1>
                        <img class="img-profile rounded-circle" src="Assests/img/undraw_profile.svg">
                        <hr>
                        <!-- Display the user details directly -->
                        <p class="card-text">Full Name: <?= htmlspecialchars($username) ?></p>
                        <p class="card-text">Email: <?= htmlspecialchars($email) ?></p>
                    </div>
                    <br>
                    <div class="text-center">
                        <a class='btn btn-outline-success text-black' data-toggle="modal" href="#updateprofileModal">Update Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateprofileModal" style="z-index:1100">
    <div class="modal-dialog" id="cont">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5">Update Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body updateuser">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($username) ?>">
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($email) ?>">
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter new password (leave empty to keep current)">
                </div>
            </div>
            <div class="modal-footer" style="display: flex; margin:auto; text-align:center;">
                <input type="button" class="btn btn-outline-danger w-20" data-dismiss="modal" value="Close">
                <input type="button" class="btn btn-outline-success" value="Update" onclick="update_user()">
            </div>
        </div>
    </div>
</div>
<br><br>
<style>
    #content_1 {
        z-index: 99%;
        width: 500px;
        overflow: hidden;
    }
    #cont {
        width: 400px;
    }
</style>
<script>
    function update_user() {
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Prepare data to be sent to the server
        const data = {
            username: username,
            email: email,
            password: password
        };

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './ProfileUpdate.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Parse the JSON response
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Show success notification
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); 
                    });
                } else {
                    // Show error notification
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } else {
                // Handle unexpected errors
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update profile. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        };
        
        // Convert data object to query string
        const queryString = new URLSearchParams(data).toString();
        xhr.send(queryString);
    }
</script>
