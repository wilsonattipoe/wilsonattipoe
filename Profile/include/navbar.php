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
    displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    header("Location: /logout.php");
    exit();
}



$userID = $_SESSION['ClientUserID'];
$username = ucwords($_SESSION['Username']);



// Query to count whitelist items for the specific user
$whitelistQuery = "SELECT COUNT(*) AS whitelist_count FROM whitelist WHERE clientusers = ?";
$stmtWhitelist = $conn->prepare($whitelistQuery);
$stmtWhitelist->bind_param('i', $userID);
$stmtWhitelist->execute();
$whitelistResult = $stmtWhitelist->get_result();
$whitelistCount = 0;
if ($whitelistResult) {
    $whitelistRow = $whitelistResult->fetch_assoc();
    $whitelistCount = $whitelistRow['whitelist_count'];
}

// Query to count cart items
$cartQuery = "SELECT COUNT(*) AS cart_count FROM addcart WHERE ClientUserID = ?";
$stmtCart = $conn->prepare($cartQuery);
$stmtCart->bind_param('i', $userID);
$stmtCart->execute();
$cartResult = $stmtCart->get_result();
$cartCount = 0;
if ($cartResult) {
    $cartRow = $cartResult->fetch_assoc();
    $cartCount = $cartRow['cart_count'];
}


// Fetch whitelist items from the database
$query = "SELECT 
        w.whitelist_id, 
        w.place_name, 
        DATE_FORMAT(w.created_at, '%Y-%m-%d') AS created_at,
        c.Username 
    FROM 
        whitelist w
    INNER JOIN 
        clientusers c 
    ON 
        w.clientusers = c.ClientUserID
    WHERE 
        w.clientusers = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userID); 
$stmt->execute();
$result = $stmt->get_result();


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

      <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">1</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Message Center</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="Assests/img/undraw_profile_1.svg" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <!-- More messages here -->
            </div>
        </li>

          <!-- Nav Item - Whitelist -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="whitelistDropdown" role="button" data-toggle="modal" data-target="#whitelistModal" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-list fa-fw"></i>
                <span class="badge badge-danger badge-counter"><?php echo $whitelistCount; ?></span>
            </a>
        </li>
        <!-- Nav Item - Cart -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button" data-toggle="modal" data-target="#caal" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart fa-fw"></i>
          <!-- Cart Badge -->
            <!-- <span class="badge badge-danger badge-counter"><?php echo $cartCount; ?></span> -->
            </a>
        </li>

                <!-- cART items -->
                <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Dynamically load cart items here -->
                                <div id="cartItems">
                                    <?php
                                    if (isset($_SESSION['ClientUserID'])) {
                                        $userID = $_SESSION['ClientUserID'];
                                        $sql = "SELECT cart_id, dateCreated FROM addcart WHERE ClientUserID = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $userID);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo <<<EOT
                                                <div class="cart-item">
                                                    <p><strong>Date Added</strong>: {$row['dateCreated']}</p>
                                                    <button class="btn btn-danger" onclick="removeItem('{$row['cart_id']}')">Remove</button>
                                                    <hr>
                                                </div>
                                                EOT;
                                            }
                                        } else {
                                            echo '<p>No items in your cart.</p>';
                                        }

                                        $stmt->close();
                                    } else {
                                        echo '<p>Error: User not logged in.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                    <!-- Whitelist Modal -->
                <div class="modal fade" id="whitelistModal" tabindex="-1" role="dialog" aria-labelledby="whitelistModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="whitelistModalLabel">Your Whitelist</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Dynamically load whitelist items here -->
                                <div id="whitelistItems">
                                    <?php
                                
                                    // Prepare the SQL statement to fetch the whitelist items for the logged-in user
                                    $sql = "SELECT 
                                                w.whitelist_id, 
                                                w.place_name, 
                                                DATE_FORMAT(w.created_at, '%Y-%m-%d') AS created_at, 
                                                c.Username AS added_by
                                            FROM 
                                                whitelist w
                                            JOIN 
                                                clientusers c
                                            ON 
                                                w.clientusers = c.ClientUserID
                                            WHERE 
                                                w.clientusers = ?";

                                    // Prepare and execute the statement
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param('i', $userID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Display the whitelist items
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo <<<EOT
                                            <div class="whitelist-item">
                                                <p><strong>Place Name</strong>: {$row['place_name']}</p>
                                                <p><strong>Added On</strong>: {$row['created_at']}</p>
                                                <p><strong>Added By</strong>: {$row['added_by']}</p>
                                                <button class="btn btn-primary" onclick="bookItem('{$row['whitelist_id']}')">Book Now</button>
                                                <hr>
                                            </div>
                                            EOT;
                                        }
                                    } else {
                                        echo '<p>No items in your whitelist.</p>';
                                    }

                                
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow" id="profile_details">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0;">
                    <!-- username -->
                    <input type="text" readonly disabled id="profile_name" value="<?php echo $username ?>" class="form-control-plaintext" style="margin-left: 10px; margin-right: 5px; margin: 0 10px 0 0;">
                    <!-- profile picture -->
                    <img src="/img/10.jpg" alt="Profile Picture" class="img-profile rounded-circle" style="width: 40px; height: 40px;">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/Profile/profile.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="openLogout()">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
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
                        <a href="/logout.php" class="btn btn-danger ml-4" id="log">Logout</a>
                        <button onclick="closeLogout()" class="btn btn-secondary ml-4" id="log">Cancel</button>
                    </form>
                </div>
            </div>
        </div>


        

        <!-- jQuery and Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // Function to open and close the logout modal
            function openLogout() { $("#logout").show(); }
            function closeLogout() { $("#logout").hide(); }

            function bookItem(id) {
                Swal.fire({
                    title: 'Are you sure you want to book this place?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, book it!',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Booked!', 'Your booking has been confirmed.', 'success');
                    }
                });
            }




            function removeItem(cartId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to recover this item!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove_cart_item.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    if (xhr.responseText.trim() === 'success') {
                        Swal.fire(
                            'Removed!',
                            'The item has been removed from your cart.',
                            'success'
                        ).then(() => {
                            // Reload or update cart items in the modal
                            location.reload(); 
                        });
                    } else {
                        Swal.fire(
                            'Failed!',
                            'There was a problem removing the item.',
                            'error'
                        );
                    }
                } else {
                    Swal.fire(
                        'Failed!',
                        'There was a problem with the request.',
                        'error'
                    );
                }
            };
            xhr.send('cart_id=' + encodeURIComponent(cartId));
        }
    });
}
        </script>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="your-integrity-code" crossorigin="anonymous" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>