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
    <h1 class="text-center">Cart</h1>
</div>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div id="tour-container">
            <!-- Tour packages will be dynamically loaded here -->
        </div>
    </div>
</div>



<!-- Add to Cart Modal -->
<div id="BookCart" class="modal fade" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">Book tour</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Book this tour?</p>
                <div class="form-group">
                    <input type="hidden" id="book_id">
                    <input type="hidden" id="price" value="5000"> <!-- Example price in GHS -->
                    <input type="hidden" type="number" id="participant" placeholder="Participants" min="1">
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                <input type="button" class="btn btn-outline-success w-20" onclick="BookCart()" value="Book tour now">
            </div>
        </div>
    </div>
</div>







<script src="https://js.paystack.co/v1/inline.js"></script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Ensure you have SweetAlert2 included -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to update the price based on participants
    function updatePrice(participantInput, priceElement, basePrice) {
        const participantCount = parseInt(participantInput.val(), 10) || 1; 
        const totalPrice = basePrice * participantCount;
        priceElement.text(`$${totalPrice.toFixed(2)}`); // Update price display
    }

    function checkLoginAndShowCartModal(tourId, basePrice) {
        <?php if (!isset($_SESSION['Username'])): ?>
            $('#loginPromptModal').modal('show');
        <?php else: ?>
            // Get the participant value from the corresponding input
            var participantInput = $(event.target).closest('.tour-card').find('.participant-input');
            var participant = participantInput.val();

            // Validate participant number
            if (participant < 1) {
                Swal.fire({
                    title: 'Invalid Number of Participants',
                    text: 'Please enter at least one participant.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Calculate total price and show in the modal
            var totalPrice = basePrice * participant;

            $('#book_id').val(tourId);
            $('#participant').val(participant);
            $('#BookCart').data('totalPrice', totalPrice); // Store total price in modal for later use
            $('#BookCart').modal('show');
        <?php endif; ?>
    }


function BookCart() {
        var id = $('#book_id').val();
        var participant = $('#participant').val();
        var userID = <?php echo json_encode($userID); ?>;
        var totalPrice = $('#BookCart').data('totalPrice'); 

        // Input validation
        if (participant < 1) {
            Swal.fire({
                title: 'Invalid Number of Participants',
                text: 'Please enter at least one participant.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

    // Generate a unique reference
    var bookingReference = 'BOOK-' + Math.floor((Math.random() * 1000000000) + 1);

    // Initialize Paystack payment
    var handler = PaystackPop.setup({
        key: 'pk_test_0555ba168ad5111f5d77d6c940c94437895d3b68', 
        email: 'customer@example.com', 
        amount: totalPrice * 100,
        currency: 'GHS', 
        ref: bookingReference, 
        callback: function(response) {
            // Handle successful payment
            $.ajax({
            type: 'POST',
            url: 'final_Book.php',
            data: {
                id: id,
                userID: userID,
                participant: participant,
                price: totalPrice, // Pass total price to backend
                reference: bookingReference // Pass the booking reference
            },
            success: function(data) {
                console.log('AJAX response:', data); // Log the raw response

                try {
                    var response = JSON.parse(data);
                    console.log('Parsed response:', response); // Log the parsed response

                    if (response.error) {
                        Swal.fire({
                            title: 'Error',
                            text: response.error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    Swal.fire({
                        title: response.success ? 'Added to cart successfully' : 'Error',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'swal-custom-container'
                        },
                    }).then(function() {
                        if (response.success) {
                            location.reload();
                            $('#BookCart').modal('hide');
                        }
                    });

                    // Send invoice email with reference and sweet message
                    sendInvoiceEmail(userID, bookingReference, totalPrice);

                } catch (e) {
                    console.error('JSON Parsing Error:', e);
                    Swal.success({
                        title: 'Error',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

        },
        onClose: function() {
            alert('Payment window closed.');
        }
    });
    handler.openIframe();
    }

    // Function to send invoice email
    function sendInvoiceEmail(userID, reference, totalPrice) {
        $.ajax({
            type: 'POST',
            url: 'send_invoice.php',
            data: {
                userID: userID,
                reference: reference,
                totalPrice: totalPrice,
                message: 'Thank you for booking with us! We hope you have an amazing experience on your tour.'
            },
            success: function(data) {
                console.log('Invoice email sent successfully.');
            },
            error: function(xhr, status, error) {
                console.error('Error sending invoice email:', status, error);
            }
        });
    }

    // Bind the change event to update the price when participant count changes
    $(document).on('change', '.participant-input', function() {
        const participantInput = $(this);
        const priceElement = participantInput.closest('.tour-card').find('.tour-price'); // Target the price element
        const basePrice = parseFloat(participantInput.data('base-price')); // Store the base price in a data attribute
        updatePrice(participantInput, priceElement, basePrice); // Update the price display
});





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

            // Get deleted tours from localStorage
            let deletedTours = JSON.parse(localStorage.getItem('deletedTours')) || [];

            data.forEach(function(tour) {
                // Skip tours that are in the deletedTours array
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
                                <input type="number" class="participant-input" placeholder="1" min="1" data-base-price="${parseFloat(tour['Price'])}">
                                <button class="btn btn-primary btn-sm" onclick="checkLoginAndShowCartModal(${tour['TourID']}, ${parseFloat(tour['Price'])});">
                                    <i class="fas fa-cart-plus"></i> Book Tour
                                </button>
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

                // Store the deleted tour ID in localStorage
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