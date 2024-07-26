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

<style>
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        color: black;
    }

    .card-text {
        flex-grow: 1;
    }

    .btn-container {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        margin-top: auto;
        /* Ensures buttons are at the bottom */
    }

    .carousel-inner img {
        height: 100%;
        object-fit: cover;
    }

    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 1,
            'wght' 700,
            'GRAD' 200,
            'opsz' 24;
    }

    .loading {
        display: none;
        text-align: center;
        margin-top: 2rem;
        font-size: 1.5rem;
        color: #666;
    }

    .no-data {
        display: none;
        text-align: center;
        margin-top: 2rem;
        font-size: 1.5rem;
        color: #f00;
    }
</style>

<div class="container" id="Special">
    <div class="loading">Loading...</div>
    <div class="no-data">No data available</div>
    <div class="card" style="width: 70rem; height: 18rem;">
        <div class="row no-gutters" id="cardContent">
            <!-- Content will be populated by JavaScript -->
        </div>
    </div>
</div>

<?php
include "../Profile/include/script.php";
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        function fetchCardData() {
            $('.loading').show(); // Show loading indicator
            $('.no-data').hide(); // Hide no data message
            $('#cardContent').empty(); // Clear previous content

            $.ajax({
                type: 'get',
                url: "fetchCardData.php", // Adjust this URL to your endpoint
                success: function(data) {
                    var response = JSON.parse(data);
                    console.log(response);

                    if (response.images.length === 0) {
                        $('.loading').hide();
                        $('.no-data').show();
                        return;
                    }

                    var indicators = '';
                    var items = '';
                    var cardContent = '';

                    for (var i = 0; i < response.images.length; i++) {
                        var isActive = i === 0 ? 'active' : '';
                        indicators += '<li data-target="#carouselExampleIndicators" data-slide-to="' + i + '" class="' + isActive + '"></li>';
                        items += '<div class="carousel-item ' + isActive + '">';
                        items += '<img class="d-block w-100" src="' + response.images[i].image_url + '" alt="' + response.images[i].image_alt + '">';
                        items += '</div>';
                    }

                    cardContent += '<div class="col-md-4">';
                    cardContent += '  <div id="carouselExampleIndicators" class="carousel slide h-100" data-ride="carousel">';
                    cardContent += '    <ol class="carousel-indicators">' + indicators + '</ol>';
                    cardContent += '    <div class="carousel-inner h-100">' + items + '</div>';
                    cardContent += '    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
                    cardContent += '      <span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                    cardContent += '      <span class="sr-only">Previous</span>';
                    cardContent += '    </a>';
                    cardContent += '    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
                    cardContent += '      <span class="carousel-control-next-icon" aria-hidden="true"></span>';
                    cardContent += '      <span class="sr-only">Next</span>';
                    cardContent += '    </a>';
                    cardContent += '  </div>';
                    cardContent += '</div>';

                    cardContent += '<div class="col-md-8">';
                    cardContent += '  <div class="card-body">';
                    cardContent += '    <p class="card-text">' + response.details.text + '</p>';
                    cardContent += '    <div class="btn-container">';
                    cardContent += '      <a href="#" class="btn btn-primary btn-lg" role="button"><span class="material-symbols-outlined">add_shopping_cart</span></a>';
                    cardContent += '      <a href="#" class="btn btn-secondary btn-lg" role="button"><span class="material-symbols-outlined">check</span></a>';
                    cardContent += '    </div>';
                    cardContent += '  </div>';
                    cardContent += '</div>';

                    $('.loading').hide();
                    $('#cardContent').html(cardContent);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('.loading').hide();
                    $('.no-data').show();
                }
            });
        }

        fetchCardData();
    });
</script>