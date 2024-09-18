<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../Profile/include/header.php');
include('../Profile/include/navbar.php');

// Check if session variables are set
if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $userID = $_SESSION['ClientUserID'];
} else {
    displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    header("Location: /logout.php");
    exit();
}
?>

<div id="booking" class="content-section" style="margin: 15px;">
    <div class="navigation">
        <ul class="ul">
            <li class="li"><a class="a" href="#" data-target="special-container">Special</a></li>
            <li class="li"><a class="a" href="#" data-target="ongoing-container">Ongoing</a></li>
            <li class="li"><a class="a" href="#" data-target="old-container">Old</a></li>
        </ul>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div id="special-container" class="tour-container">
            <!-- Special tours will be dynamically loaded here -->
        </div>
        <div id="ongoing-container" class="tour-container" style="display:none;">
            <!-- Ongoing tours will be dynamically loaded here -->
        </div>
        <div id="old-container" class="tour-container" style="display:none;">
            <!-- Old tours will be dynamically loaded here -->
        </div>
    </div>
</div>

<script>
function loadTours(targetContainer, tourType) {
    $.ajax({
        url: 'BookedTour_script.php',
        method: 'GET',
        dataType: 'json',
        data: { type: tourType },  // Pass the tour type here
        success: function(data) {
            $('#' + targetContainer).empty();

            data.forEach(function(tour) {
                let tourHtml = `
                <div class="card tour-card mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../uploads/${tour['tourimages']}" class="img-fluid rounded-start" alt="${tour['TourName']}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column mt-10">
                                <h5 class="card-title">${tour['TourName']}</h5>
                                <p class="card-text">${tour['tourdescription']}</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div>
                                        <small class="text-muted ml-3"><i class="fa fa-calendar-alt text-primary me-2"></i>${tour['TourDuration']} Days</small>
                                        <small class="text-muted ms-3 ml-3"><i class="fa fa-user text-primary me-2"></i>${tour['numberperson']} Person</small>
                                    </div>
                                    <h3 class="mb-0 ml-1">$${parseFloat(tour['Price']).toFixed(2)}</h3>
                                    <button class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;" 
                                            data-session="${tour['isLoggedIn'] ? 'true' : 'false'}" 
                                            onclick="checkLogin('/booking.php')">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('#' + targetContainer).append(tourHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch tours:', status, error);
        }
    });
}

$(document).ready(function() {
    // Initially load the special tours
    loadTours('special-container', 'special');

    $('.navigation .a').click(function(e) {
        e.preventDefault();

        var targetContainer = $(this).data('target');
        var tourType = targetContainer.replace('-container', '');  

        // Hide all containers
        $('.tour-container').hide();

        // Show the targeted container
        $('#' + targetContainer).show();

        // Load tours for the selected container
        loadTours(targetContainer, tourType);
    });
});

</script>

































<style>
/* Card styling */
.tour-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 200px;
}

/* Ensure the image fits the card */
.tour-card img {
    height: 70%;
    object-fit: cover;
}

/* Card body content styling */
.tour-card .card-body {
    padding: 20px;
}

/* Align text and button */
.tour-card .d-flex {
    width: 100%;
}

/* Button styling */
.tour-card button {
    margin-left: auto;
}

/* Container for navigation */
.navigation {
    width: 400px;
    height: 50px;
    background-color: blueviolet;
    border-radius: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
    border: 2px solid blue;
}

/* Unordered list styling */
.ul {
    padding: 0;
    margin: 0;
    list-style-type: none;
    display: flex;
    justify-content: space-around; /* Evenly spaces out list items */
    width: 100%;
}

/* List item styling */
.li {
    display: inline-block;
}

/* Anchor tag styling */
.li .a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 15px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

/* Hover effect for anchor tags */
.li .a:hover {
    background-color: gray;
    transform: scale(1.1); /* Slightly enlarges the link on hover */
}

/* Active state (for example, when a page is selected) */
.li .a.active {
    background-color: mediumorchid;
}

/* Tour container styling */
.tour-container {
    display: none;
}

</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
