<?php
session_start();
?>

<style>
    .cookie-consent {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #343a40;
        color: #ffffff;
        padding: 20px;
        display: none;
        z-index: 1000;
    }
</style>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Cookie Consent Popup -->
<div id="cookieConsent" class="cookie-consent">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <p>We use cookies to enhance your browsing experience. By continuing to use our website, you agree to our use of cookies. <a href="cookies.php" class="text-info">Learn more</a></p>
            </div>
            <div class="col-md-2 text-right">
                <button id="acceptCookies" class="btn btn-primary">Accept</button>
            </div>
        </div>
    </div>
</div>

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Travel & Tour</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 align-items-center">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="Tours.php" class="nav-item nav-link">Tours</a>
                <a href="service.php" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="destination.php" class="dropdown-item">Destination</a>
                        <!-- <a href="booking.php" class="dropdown-item">Booking</a> -->
                        <a href="team.php" class="dropdown-item">Travel Guides</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>

                <!-- Conditional Dropdown Menu -->
                <div class="nav-item dropdown">
                    <div class="nav-item dropdown">
                        <?php if (isset($_SESSION['ClientUserID'])): ?>
                            <!-- User is logged in -->
                            <a class="btn custom-dropdown-button dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-alt me-2">
                                    <?php echo isset($_SESSION['Username']) ? htmlspecialchars($_SESSION['Username']) : 'User'; ?>
                                </i>
                            </a>
                            <div class="dropdown-menu p-2 shadow" aria-labelledby="dropdownMenuButton" style="border-radius:8%; color:aqua;">
                                <a class="dropdown-item d-flex align-items-center" href="/Profile/Booking.php">
                                    <i class="fa fa-user me-2"></i>Dashboard
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                    <i class="fa fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="/FAQ.php" data-bs-toggle="modal" data-bs-target="#helpModal">
                                    <i class="fa fa-question-circle me-2"></i>Help
                                </a>
                            </div>
                        <?php else: ?>
                            <a class="nav-link dropdown-toggle"
                                id="dropdownMenuButton"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                style="color: white; font-size: 16px; padding: 10px; border-radius: 50px; background-color: #343a40; transition: background-color 0.3s ease;">
                                <i class="fa fa-user-alt me-2" style="color: white;"> guest</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" style="color: white; font-size: 14px; padding: 10px 20px; text-decoration: none; display: block;">Login</a>
                                <a class="dropdown-item" href="#" style="color: white; font-size: 14px; padding: 10px 20px; text-decoration: none; display: block;">Sign Up</a>
                            </div>

                            <div class="dropdown-menu p-2 shadow" aria-labelledby="dropdownMenuButton" style="border-radius:8%;">
                                <a class="dropdown-item d-flex align-items-center" href="/signup.php">
                                    <i class="fa fa-sign-in-alt me-2"></i>Login/Signup
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="/FAQ.php" data-bs-toggle="modal" data-bs-target="#helpModal">
                                    <i class="fa fa-question-circle me-2"></i>Help
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
    </nav>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true" style="z-index:1050; ">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">Help and Support</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>If you need help or support, please contact our support team at <a href="mailto:traveltour391@gmail.com">traveltour391@gmail.com</a>.</p>
                    <p>You can also visit our <a href="/FAQ.php">FAQ page</a> for common questions and answers.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Tour With Us</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Escape to a world of relaxation and adventure with our premium vacation packages. Whether you're dreaming of sandy beaches, vibrant cityscapes, or serene countryside retreats, we offer a range of destinations tailored to your desires.</p>
                    <div class="position-relative w-75 mx-auto animated slideInDown">
                        <!-- <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" name="query" type="text" placeholder="Eg: HO">
                        <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Hide spinner after page load
    window.addEventListener('load', function() {
        var spinner = document.getElementById('spinner');
        spinner.style.display = 'none';

        // Show cookie consent popup
        var cookieConsent = document.getElementById('cookieConsent');
        cookieConsent.style.display = 'block';
    });

    // Handle accept cookies button click
    document.getElementById('acceptCookies').addEventListener('click', function() {
        var cookieConsent = document.getElementById('cookieConsent');
        cookieConsent.style.display = 'none';

        // Set a cookie to remember the user's consent
        document.cookie = "cookiesAccepted=true; path=/; max-age=" + 60 * 60 * 24 * 365;
    });

    // Check if the user has already accepted cookies
    if (document.cookie.split(';').some((item) => item.trim().startsWith('cookiesAccepted='))) {
        document.getElementById('cookieConsent').style.display = 'none';
    }
</script>