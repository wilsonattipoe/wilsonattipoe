<?php
include("./include/navbar.php");
include("./include/header.php");
include("./Database/connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$isLoggedIn = isset($_SESSION['ClientUserID']);
$ClientUserID = $isLoggedIn ? $_SESSION['ClientUserID'] : null;
?>


<div id="tour-container">
    <!-- Tour packages will be dynamically loaded here -->
</div>



<!-- Add to Cart Modal -->
<div id="AddCart" class="modal fade" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">Add to Cart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to add this tour to your cart?</p>
                <div class="form-group">
                    <input type="hidden" id="cart_id"> <!-- Hidden input for tour ID -->
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-success w-20" data-dismiss="modal" value="Close">
                <input type="button" class="btn btn-outline-danger" onclick="AddCart()" value="Add to Cart">
            </div>
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

<!-- Login Prompt Modal -->
<div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true" style="z-index:1050;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginPromptModalLabel">Hello, Guest! Please Log In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You need to log in before you can book a tour or add it to your cart. Please log in to continue.</p>
                <a href="/login.php" class="btn btn-primary">Log In</a>
                <a href="/signup.php" class="btn btn-secondary">Sign Up</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function AddCart() {
        var id = $('#cart_id').val();
        var userID = <?php echo json_encode($ClientUserID); ?>;
        $.ajax({
            type: 'post',
            url: 'fetch_Cart.php',
            data: {
                id: id,
                userID: userID,
            },
            success: function(data) {
                var response = JSON.parse(data);
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
                        $('#AddCart').modal('hide');
                    }
                });
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
    }

    function loadTours() {
        $.ajax({
            url: 'fetch_all_tours.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#tour-container').empty();
                data.forEach(function(tour) {
                    let tourHtml = `
                        <div class="tour-card">
                            <img src="../uploads/${tour['tourimages']}" class="card-img-top" alt="${tour['TourName']}" onclick="showImagePreview('../uploads/${tour['tourimages']}')">
                            <div class="card-body">
                                <h5 class="card-title">${tour['TourName']}</h5>
                                <p class="card-text">${tour['tourdescription']}</p>
                               <p class="card-text">
                                <spam> Start Date:</spam> ${new Date(tour['start_date']).toLocaleDateString()} 
                                <spam> End Date:</spam> ${new Date(tour['end_date']).toLocaleDateString()} 
                                </p>

                                <h3 class="mb-0">$${parseFloat(tour['Price']).toFixed(2)}</h3>
                                <p class="card-text"><strong>Status:</strong> <span class="status-${tour['tourStatus'].toLowerCase()}">${tour['tourStatus']}
                                <button class="btn btn-primary btn-sm" onclick="checkLoginAndShowCartModal(${tour['TourID']}, ${tour['tourID']});">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </span></p>
                               
                            </div>
                        </div>`;
                    $('#tour-container').append(tourHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch tours:', status, error);
            }
        });
    }

    function showImagePreview(imageSrc) {
        $('#previewImage').attr('src', imageSrc);
        $('#imagePreviewModal').modal('show');
    }

    function checkLoginAndShowCartModal(tourServicesId, tourId) {
        if (!<?php echo json_encode($isLoggedIn); ?>) {
            $('#loginPromptModal').modal('show');
        } else {
            $('#cart_id').val(tourId);
            $('#AddCart').modal('show');
        }
    }

    $(document).ready(function() {
        loadTours();
    });
</script>



<style>
    /* Container for the grid */
    .tour-container {
        display: grid;

        grid-gap: 5px;
        /* Further reduces the gap between the cards */
        padding: 20px;
        /* Reduced padding */
        margin: 0 auto;
        max-width: 90%;
        /* Container width */
        outline: 2px solid #ccc;
        /* Adds an outline to the container */
        border-radius: 10px;
        /* Optional: Adds some roundness to the container */
    }

    /* Tour card styles */
    .tour-card {

        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: row;
        align-items: center;
        height: 35%;
        margin-top: 30px;
        padding: 20px;
        outline: 2px solid #ccc;

    }

    .tour-card img {
        height: 180px;
        /* Slightly reduced height */
        width: 180px;
        /* Slightly reduced width */
        object-fit: cover;
        cursor: pointer;
    }


    .tour-card .text-right {
        margin-top: 10px;
        /* Slightly reduced margin */
    }

    .tour-card button {
        margin-left: 5px;
        float: inline-end;
    }

    /* Spam styles for bold and black text */
    spam {
        font-weight: bold;
        color: black;
    }
</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<?php
include("./scripts/scriptsLinks.php");
include("./include/footer.php");
?>