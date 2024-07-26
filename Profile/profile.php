<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);



include('../Profile/include/header.php');
include('../Profile/include/navbar.php');



if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $userID = $_SESSION['ClientUserID'];
    

       


   
} else {
    displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    header("Location: /login.php");
    exit();
}

?>


<div class="container mt-5">
    <h2>User Profile</h2>

    <form id="profile-picture-form" action="update_profile.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profilePicture">Profile Picture</label>
            <div class="mb-3">
                
            </div>
            <input type="file" class="form-control-file" id="profilePicture" name="profilePicture">
        </div>
        <button type="submit" name="updateProfilePicture" class="btn btn-primary"><i class="fas fa-save"></i> Update Profile Picture</button>
    </form>
    <hr>

    <form id="name-form" action="update_profile.php" method="post">
        <div class="form-group">
            <label for="userName">Name</label>
            <input type="text" class="form-control" id="userName" name="name" required>
        </div>
        <button type="submit" name="updateName" class="btn btn-primary"><i class="fas fa-save"></i> Update Name</button>
    </form>
    <hr>

    <form id="email-form" action="update_profile.php" method="post">
        <div class="form-group">
            <label for="userEmail">Email</label>
            <input type="email" class="form-control" id="userEmail" name="email" required>
        </div>
        <button type="submit" name="updateEmail" class="btn btn-primary"><i class="fas fa-save"></i> Update Email</button>
    </form>
    <hr>

    <form id="phone-form" action="update_profile.php" method="post">
        <div class="form-group">
            <label for="userPhone">Phone</label>
            <input type="tel" class="form-control" id="userPhone" name="phone">
        </div>
        <button type="submit" name="updatePhone" class="btn btn-primary"><i class="fas fa-save"></i> Update Phone</button>
    </form>
    <hr>

    <form id="address-form" action="update_profile.php" method="post">
        <div class="form-group">
            <label for="userAddress">Address</label>
            <textarea class="form-control" id="userAddress" name="address" rows="3"></textarea>
        </div>
        <button type="submit" name="updateAddress" class="btn btn-primary"><i class="fas fa-save"></i> Update Address</button>
    </form>
    <hr>

    <form id="password-form" action="update_profile.php" method="post">
        <div class="form-group">
            <label for="userPassword">Password</label>
            <input type="password" class="form-control" id="userPassword" name="password">
            <small class="form-text text-muted">Leave blank if you do not want to change your password.</small>
        </div>
        <button type="submit" name="updatePassword" class="btn btn-primary"><i class="fas fa-save"></i> Update Password</button>
    </form>
</div>
<?php
include "../Profile/include/script.php";
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<?php
include "../Profile/include/script.php";
?>