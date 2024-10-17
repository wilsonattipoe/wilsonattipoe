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
    header("Location: /logout.php");
    exit();
}
?>
<div id="booking" class="content-section" style="margin: 15px;">
    <h1 class="text-center">All Booked Tour </h1>
</div>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div id="tour-container">
            <!-- Tour packages will be dynamically loaded here -->
        </div>
    </div>
</div>



<!-- Image Preview Modal -->
<div id="imagePreviewModal" class="modal fade" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true" style="z-index: 1100;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img id="previewImage" src="" class="img-fluid" alt="Tour Image">
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Ensure you have SweetAlert2 included -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
 
 function loadTours() {
    var userID = <?php echo json_encode($userID); ?>;
    $.ajax({
        url: 'fetch_Cart_details.php',
        method: 'GET',
        data: {
            userID: userID
        },
        dataType: 'json',
        success: function(data) {
            $('#tour-container').empty();

            // Check for errors in the response
            if (data.error) {
                $('#tour-container').append(`<p class="text-danger">${data.error}</p>`);
                return;
            }

            if (data.length === 0) {
                $('#tour-container').append('<p>No tours in your cart.</p>');
                return;
            }

            // Get deleted tour IDs from local storage
            let deletedTours = JSON.parse(localStorage.getItem('deletedTours')) || [];

            data.forEach(function(tour) {
                // Skip tours that are marked as deleted
                if (deletedTours.includes(tour['TourID'])) {
                    return;
                }

                // Limit the description to 50 words
                let description = tour['tourdescription'].split(' ').slice(0, 50).join(' ') + '...';

                let tourHtml = `
                    <div class="card tour-card mb-4" id="tour-${tour['TourID']}">
                        <div class="card-body">
                            <img src="../uploads/${tour['tourimages']}" alt="${tour['TourName']}">
                            <div>
                                <h5 class="card-title">${tour['TourName']}</h5>
                                <p>${description}</p>
                                <p class="text-muted">
                                    <i class="fa fa-calendar-alt text-primary"></i> ${tour['TourDuration']} Days | 
                                    ${tour['start_date']} - ${tour['end_date']}
                                </p>
                            </div>
                            <div class="price-button-container">
                                <h3 class="mb-0 tour-price ml-1">$${parseFloat(tour['Price']).toFixed(2)}</h3>
                                <button class="btn btn-danger btn-sm delete-button" data-tour-id="${tour['TourID']}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>`;

                $('#tour-container').append(tourHtml);
            });

            // Event delegation for delete buttons
            $('#tour-container').on('click', '.delete-button', function() {
                const tourID = $(this).data('tour-id');
                $(`#tour-${tourID}`).remove();

                // Add the deleted tour ID to local storage
                let deletedTours = JSON.parse(localStorage.getItem('deletedTours')) || [];
                if (!deletedTours.includes(tourID)) {
                    deletedTours.push(tourID);
                    localStorage.setItem('deletedTours', JSON.stringify(deletedTours));
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch tours:', status, error);
            $('#tour-container').append('<p class="text-danger">Failed to load tours. Please try again later.</p>');
        }
    });
}

function showImagePreview(imageSrc) {
    $('#previewImage').attr('src', imageSrc);
    $('#imagePreviewModal').modal('show');
}

$(document).ready(function() {
    loadTours();
});

</script>


<?php include("./include/footer.php"); ?>
<style>
    .tour-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        height: auto;
        padding: 15px;
    }

    /* Tour image size */
    .tour-card img {
        height: 50px;
        width: 50px;
        object-fit: cover;
        border-radius: 5px;
    }

    /* Card body content styling */
    .tour-card .card-body {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Description size and truncation */
    .tour-card p {
        font-size: 14px;
        line-height: 1.4;
        max-width: 400px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }

    /* Align text and button */
    .tour-card .d-flex {
        width: 100%;
        align-items: center;
    }

    /* Button styling */
    .tour-card button {
        margin-left: 10px;
        font-size: 14px;
        padding: 5px 10px;
    }

    /* Small input field styling */
    .participant-input {
        width: 60px;
        height: 30px;
        font-size: 12px;
        padding: 3px;
        margin-right: 10px;
    }

    /* Pricing text and button on the same line */
    .tour-card .price-button-container {
        display: flex;
        align-items: center;
    }

    .tour-card .price-button-container h3 {
        font-size: 16px;
        margin-right: 10px;
    }

    /* Text on a single line */
    .tour-card .text-muted {
        font-size: 10px;
        white-space: nowrap;
    }

    /* Reduce text size for smaller look */
    .tour-card .card-title {
        font-size: 14px;
    }
</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>