<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./include/header.php");
include("./include/navbar.php");
include("./Database/connect.php");


$isLoggedIn = isset($_SESSION['ClientUserID']);
$ClientUserID = $isLoggedIn ? $_SESSION['ClientUserID'] : null;

?>
<div id="booking" class="content-section" style="margin: 15px;">
  <h1 class="text-center">Festival  tour</h1> 
</div>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div id="tour-container">
            <!-- Tour packages will be dynamically loaded here -->
        </div>
    </div>
</div>

<!-- Book Modal -->
<div id="BookModel" class="modal fade" style="z-index:1100" >
    <div class="modal-dialog" >
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">Book tour</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Book this tour?</p>
            </div>
            <input type="hidden" id="book_id">
            <div class="modal-footer">
                <input type="button"  class="btn btn-outline-success w-20" data-dismiss="modal" value="close">
                <input type="submit" class="btn btn-outline-danger" onclick="BookTour()" value="Book now">
            </div>
        </div>
    </div>
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
                <form id="addToCartForm">
                    <div class="form-group">
                        <input type="hidden" id="cart_id"> <!-- Hidden input for tour ID -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-success w-20" data-dismiss="modal" value="Close">
                <input type="button" class="btn btn-outline-danger" onclick="AddCart()" value="Add to Cart">
            </div>
        </div>
    </div>
</div>

<!-- book tour -->
<script>
    function BookTour() {
        console.log("AddCart function called");
        var id = $('#cart_id').val();
        var userID = <?php echo json_encode($ClientUserID); ?>;

        if (!userID) {
            $('#loginPromptModal').modal('show');
        } else {$.ajax({
            type: 'post',
            url: './fetch_festival.php',
            data: {
                id: id,
                userID: userID
            },
            success: function(data) {
                var response = JSON.parse(data);

                Swal.fire({
                    title: response.success ? 'Success' : 'Error',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        container: 'swal-custom-container',
                    },
                }).then(function() {
                    if (response.success) {
                        location.reload();
                        $('#BookModel').modal('hide');
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
}
function AddCart() {
        var id = $('#cart_id').val();
        var userID = <?php echo json_encode($ClientUserID); ?>;
        var quantity = $('#cartQuantity').val();

        $.ajax({
            type: 'post',
            url: 'fetch_Cart.php',
            data: { userID: userID, quantity: quantity },
            success: function(data) {
                var response = JSON.parse(data);
                Swal.fire({
                    title: response.success ? 'Added to cart successfully' : 'Error',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    confirmButtonText: 'OK',
                    customClass: { container: 'swal-custom-container' },
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
// <!-- fetch tour -->

function loadTours() {
    $.ajax({
        url: './fetch_festival.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#tour-container').empty();

            data.forEach(function(tour) {
                let tourHtml = `<div class="tour-container">
                    <img src="../uploads/${tour['tourimages']}" class="card-img-top" alt="${tour['tourname']}">
                    <div class="card-body">
                        <h5 class="card-title">${tour['tourname']}</h5>
                        <p class="card-text">${tour['description']}</p>
                        <p class="card-text">Date: ${new Date(tour['create_at']).toLocaleDateString()}</p> 
                        <h3 class="mb-0">$${parseFloat(tour['Price']).toFixed(2)}</h3>
                        <p class="card-text">
                            <strong>Status:</strong> 
                            <span class="status-${tour['tourstatus'].toLowerCase()}">${tour['tourstatus']}</span>
                        </p>
                    <div class="text-right">
                        <button class="btn btn-primary btn-sm" onclick="checkLoginAndShowCartModal(${tour['tourservices_id']}, ${tour['tourID']});">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-outline-danger btn-sm" onclick="checkLoginAndShowBookModal(${tour['tourservices_id']}, ${tour['tourID']});">
                            <i class="fas fa-book"></i> Book Now
                        </button>
                    </div>
                    </div>
                </div>
            </div>

            `;
                $('#tour-container').append(tourHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch tours:', status, error);
        }
    });
}





function checkLoginAndShowCartModal(tourId) {
        if (!<?php echo json_encode($isLoggedIn); ?>) {
            $('#loginPromptModal').modal('show');
        } else {
            $('#cart_id').val(tourId);
            $('#AddCart').modal('show');
        }
    }

    function checkLoginAndShowBookModal(tourId) {
        if (!<?php echo json_encode($isLoggedIn); ?>) {
            $('#loginPromptModal').modal('show');
        } else {
            $('#book_id').val(tourId);
            $('#BookModel').modal('show');
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
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px; /* Space between cards */
    padding: 20px;
    flex-direction: row;
}

/* Card styling */
.status-ongoing {
    color: green !important;
    font-weight: bold;
}

.status-ended {
    color: red !important;
    font-weight: bold;
}

.status-pending {
    color: orange !important;
    font-weight: bold;
}

.tour-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
}

/* Ensure the image fits the card */
.tour-card img {
    height: 260px;
    width: 100%;
    object-fit: cover;
    flex-direction: column;
    display: inline-flex;
}

/* Card body content styling */
.tour-card .card-body {
    padding: 15px;
    flex: 1;
}

/* Align text and button */
.tour-card .text-right {
    margin-top: auto; /* Pushes buttons to the bottom of the card */
}

/* Button styling */
.tour-card button {
    margin-left: 5px;
}

</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include("../scripts/scriptsLinks.php");
include("../include/footer.php");
?>