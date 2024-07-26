<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/navbar.php');
?>









<div class="container" style="margin-top:80px;" id="profile">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 col-md-4">
            <div class="card shadow">
                <!-- Display user's image -->
                <?php
                // Fetch the user's profile picture file path from the database
                $imageQuery = "SELECT data FROM image WHERE user_id = '$userId'";
                $imageResult = mysqli_query($conn, $imageQuery);

                if (mysqli_num_rows($imageResult) > 0) {
                    $imageData = mysqli_fetch_assoc($imageResult);
                    $imagePath = $imageData['data'];

                    echo '<div class="d-flex justify-content-center align-items-center mt-4">';
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="No Profile Found" class="img rounded-circle" height="150px"  width="150px"/>';
                    } else {
                        echo '<img src="images/default_profile.jpg" alt="No Profile Found" class="img rounded-circle" height="150px"  width="150px"/>';
                    }
                    echo '</div>';
                }
                ?>
                <div class="card-body" style="justify-content:center;">
                <div class="text-center">
                        <h1 class="text-center">Profile</h1>
                        <hr>
                        <?php if (isset($username)) : ?>
                            <p class="card-text" style="margin-right:158px;">Full Name: <?= $username ?></p>
                        <?php endif; ?>
                        <?php if (isset($email)) : ?>
                            <p class="card-text">Email: <?= hideEmail($email, 10) ?></p>
                        <?php endif; ?>
                        <?php if (isset($phone)) : ?>
                            <p class="card-text" style="margin-right:120px;">Phone: <?= hidePhone($phone, 7) ?></p>
                        <?php endif; ?>
                    </div>

                    <?php
                    // Function to hide a portion of the email address
                    function hideEmail($email, $middleCharsToHide) {
                        list($username, $domain) = explode('@', $email);
                        $visibleUsername = $username;
                        
                        $hiddenPartLength = min($middleCharsToHide, strlen($username));
                        $hiddenUsername = str_repeat('*', $hiddenPartLength);

                        return $hiddenUsername . substr($username, $hiddenPartLength) . '@' . $domain;
                    }

                    // Function to hide a portion of the phone number
                    function hidePhone($phone) {
                        $visibleChars = 5;
                        $hiddenPart = str_repeat('*', strlen($phone) - $visibleChars);
                        
                        return substr_replace($phone, $hiddenPart, 0, strlen($phone) - $visibleChars);
                    }
                    ?>
                    <br>
                    <div class="text-center">
                      <a class='btn btn-outline-success text-black' data-toggle="modal" href="#updateprofileModal" onclick="viewData()">Update Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- //UPdate Profile -->
<div class="modal fade " id="updateprofileModal"style="z-index:1100" >
<div class="modal-dialog" id="cont">
    <div class=" modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title fs-5">Update Profile</h4>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
            </div>
            <div class="modal-body updateuser">
               
                    <div class="form-group">
                        <label>Upload Image:</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <input type="submit" value="Save Changes" class="btn btn-outline-success w-20" name="submit" onclick="update_image()" style="margin-top: 5px;">
                    </div>
               

                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" id="username">
                    <input type="text" class="form-control" hidden id="user_id">
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" id="phone">
                </div>

            </div>
            <div class="modal-footer" style="display: flex; margin:auto; text-align:center;">
                <input type="button"  class="btn btn-outline-danger w-20" data-dismiss="modal" value="close">
                <input type="submit" class="btn btn-outline-success" value="update" onclick="update_user()">
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
    #cont{
        width: 400px;
    }

</style>








<?php
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>







