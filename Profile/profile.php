<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../Profile/include/header.php');
include('../Profile/include/navbar.php');
include('./Database/connect.php'); 

// Check if the user is logged in
if (!isset($_SESSION['ClientUserID'])) {
    echo "You need to log in to view this page.";
    exit();
}

$currentUser = $_SESSION['ClientUserID'];

// Fetch user data
$sql = "SELECT `Username`, `Email` FROM `clientusers` WHERE `ClientUserID` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $currentUser);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();
?>

<div class="container" style="margin-top:80px;" id="profile">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h1 class="text-center">Profile</h1>
                    <hr>
                    <?php if (isset($username)) : ?>
                            <p class="card-text">Full Name: <?= $username ?></p>
                    <?php endif; ?>

                    <p class="card-text">Email: <?= htmlspecialchars($userData['Email']) ?></p>
                    <br>
                    <a class="btn btn-outline-success" data-toggle="modal" href="#updateProfileModal">Update Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5">Update Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="updateProfileForm">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($userData['Username']) ?>">
                        <input type="hidden" id="user_id" name="user_id" value="<?= htmlspecialchars($currentUser) ?>">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userData['Email']) ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-success" onclick="update_user()">Update</button>
            </div>
        </div>
    </div>
</div>

<style>
    #updateProfileModal .modal-dialog {
        max-width: 400px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function update_user() {
        const formData = new FormData(document.getElementById('updateProfileForm'));
        $.ajax({
            url: 'update_profile.php', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    swal({
                        title: "Success",
                        text: "Profile updated successfully.",
                        icon: "success"
                    }).then(() => {
                        location.reload(); 
                    });
                } else {
                    swal("Error", response.error, "error");
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                swal("Error", "An error occurred while updating the profile.", "error");
            }
        });
    }
</script>
