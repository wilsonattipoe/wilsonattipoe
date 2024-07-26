<?php
include "../Profile/include/sidebar.php";
include('./Database/connect.php');
function displayMessage($title, $text, $icon, $redirectUrl = null)
{
    echo <<<EOT
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.options = {
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "progressBar": true,
                    "timeOut": "3000" // 3 seconds
                };
                toastr["$icon"]("$text", "$title");

                // Check if a redirect URL is provided
                if ("$redirectUrl" !== '') {
                    setTimeout(function() {
                        window.location.href = "$redirectUrl";
                    }, 3000); // Redirect after 3 seconds
                }
            });
        </script>
EOT;
}


if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $userID = $_SESSION['ClientUserID'];
} else {
    displayMessage('Error', 'Session not set.', 'error', '/login.php');
    header("Location: /login.php");
    exit();
}

?>

<!-- Content Wrapper -->


<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto static-top">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>



                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="Assests/img/undraw_profile_1.svg" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="Assests/img/undraw_profile_2.svg" alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="Assests/img/undraw_profile_3.svg" alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very happy with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow" id="profile_details">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <!-- username -->
                        <input type="text" readonly disabled id="profile_name" value="<?php echo $username ?>" class="form-control-plaintext" style="margin-left:10%;">
                        <!-- username -->
                        <?php
                        // Fetch the user's profile picture file path from the database
                        $imageQuery = "SELECT `ImageURL` FROM `ClientUserImages` WHERE `ClientUserID` = '$userID'";
                        $imageResult = mysqli_query($conn, $imageQuery);


                        if (mysqli_num_rows($imageResult) > 0) {
                            $imageData = mysqli_fetch_assoc($imageResult);
                            $imagePath = $imageData['data'];
                            // Display the user's profile picture
                            echo '<img src="' . $imagePath . '" alt="No Profile Found" class="img-profile rounded-circle" />';
                        } else {
                            // If the user doesn't have a profile picture, you can display a default image

                            echo '<img src="" alt="No Profile Found" style="vertical-align: middle; margin-right:30%;  height=1px; width=1px" />';
                        }
                        ?>
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="/Profile/profile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="openLogout()">
                            <i class=" fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Logout Modal-->
        <div id="logout" class="modal" style="display: none; z-index: 1100;">
            <div class="modal-content card">
                <div class="card-body">
                    <h5 class="card-title">Are you sure you want to Logout?</h5>
                    <form>
                        <a href="/login.php" class="btn btn-danger ml-4" id="log">Logout</a>
                        <button onclick="closeLogout()" class="btn btn-secondary ml-4" id="log">Cancel</button>
                    </form>
                </div>
            </div>
        </div>



        <script>
            // Function to open the password change modal
            function openLogout() {
                var Logout = document.getElementById("logout");
                Logout.style.display = "block";
            }

            // Function to close the password change modal
            function closeLogout() {
                var Logout = document.getElementById("logout");
                Logout.style.display = "none";
            }

            $(document).ready(function() {
                var id = <?php echo $userID; ?>;

                userData(id);

                function userData(id) {
                    $.ajax({
                        type: 'get',
                        data: {
                            id: id
                        },
                        url: "./user_detail.php",
                        success: function(data) {
                            var response = JSON.parse(data);
                            $('#profile_details #profile_name').val(response.Username);
                        }
                    });
                }

                $(document).ready(function() {
                    userData(id);
                });
            });
        </script>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="your-integrity-code" crossorigin="anonymous" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>