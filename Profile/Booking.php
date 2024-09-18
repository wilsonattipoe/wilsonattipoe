<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("./Database/connect.php");
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

// Query to fetch all current bookings for the logged-in user
$sql_current = "SELECT 	
        bt.ClientUserID,
        bt.bookTour_ID,
        bt.price,
        bt.ClientUserID,
        bt.room_id,
        bt.participants,
        a.ActionName AS action_status,
        bt.country_id,
        bt.tourType_id,
        bt.tourSite_id,
        bt.status,
        bt.Dated,
        tt.TourTypeName,
        r.Rooms_Name,
        c.country_name
    FROM 
        booktours bt
    JOIN 
        tourtypes tt ON bt.tourType_id = tt.TourTypeID
    JOIN
        room r ON bt.room_id = r.Room_id
    JOIN
        countries c ON bt.country_id = c.country_id
    JOIN
        actions a ON bt.action_id = a.ActionID
    WHERE
        a.ActionName IN ('Pending', 'Ongoing', 'Completed') 
    AND 
        bt.ClientUserID = ?"; 

$stmt_current = $conn->prepare($sql_current);
$stmt_current->bind_param('i', $userID);
$stmt_current->execute();
$result_current = $stmt_current->get_result();

$bookings_current = [];
if ($result_current->num_rows > 0) {
    while($row = $result_current->fetch_assoc()) {
        $bookings_current[] = $row;
    }
}

// Query to fetch existing bookings with status 'Rejected' or 'Ended' for the logged-in user
$sql_existing = "SELECT 
        bt.bookTour_ID,
        bt.price,
        bt.ClientUserID,
        bt.room_id,
        bt.participants,
        a.ActionName AS action_status,
        bt.country_id,
        bt.tourType_id,
        bt.tourSite_id,
        bt.action_id,
        bt.Dated,
        tt.TourTypeName,
        r.Rooms_Name,
        c.country_name
    FROM 
        booktours bt
    JOIN 
        tourtypes tt ON bt.tourType_id = tt.TourTypeID
    JOIN
        room r ON bt.room_id = r.Room_id
    JOIN
        countries c ON bt.country_id = c.country_id
    JOIN
        actions a ON bt.action_id = a.ActionID
    WHERE
        a.ActionName IN ('Rejected', 'Ended')
    AND 
        bt.ClientUserID = ?"; 

$stmt_existing = $conn->prepare($sql_existing);
$stmt_existing->bind_param('i', $userID);
$stmt_existing->execute();
$result_existing = $stmt_existing->get_result();

$bookings_existing = [];
if ($result_existing->num_rows > 0) {
    while($row = $result_existing->fetch_assoc()) {
        $bookings_existing[] = $row;
    }
}
$conn->close();
?>



<div id="booking" class="content-section" style="margin: 15px;">
    <h1 class="text-center">Booking</h1>
</div>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div id="tour-container" class="row">
        </div>
    </div>
</div>






<!-- Booking Modal -->
<div class="modal fade" id="BookModel" tabindex="-1" role="dialog" aria-labelledby="BookModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BookModelLabel">Book Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <input type="hidden" id="tourID" name="tourID">
                    <div class="form-group">
                        <label for="bookingDate">Date</label>
                        <input type="date" class="form-control" id="bookingDate" name="bookingDate">
                    </div>
                    <div class="form-group">
                        <label for="participants">Number of Participants</label>
                        <input type="number" class="form-control" id="participants" name="participants" min="1">
                    </div>
                    <div class="form-group">
                        <label for="roomSelect">Select Room</label>
                        <select class="form-control" id="roomSelect" name="roomSelect">
                            <!-- Room options will be populated here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="countrySelect">Select Country</label>
                        <select class="form-control" id="countrySelect" name="countrySelect">
                            <!-- Country options will be populated here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tourTypeSelect">Select Tour Type</label>
                        <select class="form-control" id="tourTypeSelect" name="tourTypeSelect">
                            <!-- Tour Type options will be populated here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tourSiteSelect">Select Tour Site</label>
                        <select class="form-control" id="tourSiteSelect" name="tourSiteSelect">
                            <!-- Tour Site options will be populated here -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="bookTour()">Book Tour</button>
            </div>
        </div>
    </div>
</div>

<!-- Cancellation Modal -->
<div class="modal fade" id="CancellationModal" tabindex="-1" role="dialog" aria-labelledby="CancellationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CancellationModalLabel">Request Cancellation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cancellationForm">
                    <input type="hidden" id="cancelTourID" name="cancelTourID">
                    <div class="form-group">
                        <label for="cancellationReason">Reason for Cancellation</label>
                        <textarea class="form-control" id="cancellationReason" name="cancellationReason" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="submitCancellation()">Submit Cancellation</button>
            </div>
        </div>
    </div>
</div>

<!-- Retrieval Modal -->
<div class="modal fade" id="RetrievalModal" tabindex="-1" role="dialog" aria-labelledby="RetrievalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RetrievalModalLabel">Request Retrieval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="retrievalForm">
                    <input type="hidden" id="retrieveTourID" name="retrieveTourID">
                    <div class="form-group">
                        <label for="retrievalReason">Reason for Retrieval</label>
                        <textarea class="form-control" id="retrievalReason" name="retrievalReason" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="submitRetrieval()">Submit Retrieval</button>
            </div>
        </div>
    </div>
</div>

<h1 style="text-align: center;margin-top:20px;">Book Tours</h1>
<!-- Current Bookings -->
<h3 class="mt-5" style="color:green;">Current Bookings</h3>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tour Name</th>
        <th>Amount GHC</th>
        <th>Room</th>
        <th>Date</th>
        <th>Tour Status</th>
        <th>Participants</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bookings_current as $booking): ?>
        <tr>
          <td><?php echo htmlspecialchars($booking['TourTypeName']); ?></td>
          <td><?php echo htmlspecialchars($booking['price']); ?></td>
          <td><?php echo htmlspecialchars($booking['Rooms_Name']); ?></td>
          <td><?php echo htmlspecialchars($booking['Dated']); ?></td>
          <td><?php echo htmlspecialchars($booking['action_status']); ?></td>
          <td><?php echo htmlspecialchars($booking['participants']); ?></td>
          <td>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#CancellationModal" data-booking-id="<?php echo $booking['bookTour_ID']; ?>">Request Cancellation</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Existing Bookings -->
<h3 class="mt-5" style="color:red;">Existing Bookings</h3>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tour Name</th>
        <th>Amount GHC</th>
        <th>Room</th>
        <th>Date</th>
        <th>Tour Status</th>
        <th>Participants</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bookings_existing as $booking): ?>
        <tr>
          <td><?php echo htmlspecialchars($booking['TourTypeName']); ?></td>
          <td><?php echo htmlspecialchars($booking['price']); ?></td>
          <td><?php echo htmlspecialchars($booking['Rooms_Name']); ?></td>
          <td><?php echo htmlspecialchars($booking['Dated']); ?></td>
          <td><?php echo htmlspecialchars($booking['action_status']); ?></td>
          <td><?php echo htmlspecialchars($booking['participants']); ?></td>
          <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#RetrievalModal" data-booking-id="<?php echo $booking['bookTour_ID']; ?>">Request Retrieval</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>



<!-- Add to Cart Modal -->
<div id="AddCart" class="modal fade" style="z-index:1500">
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













<script>
function BookTour() {
    var id = $('#tourID').val();
    var userID = <?php echo json_encode($userID); ?>;
    var date = $('#bookingDate').val();
    var participants = $('#participants').val();


    // Fetch Booking Functions
    $.ajax({
        type: 'post',
        url: 'fetch_book.php',
        data: {
            id: id,
            userID: userID,
            date: date,
            participants: participants
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



// Add to cart Functions
function AddCart() {
    var id = $('#cart_id').val();
    var userID = <?php echo json_encode($userID); ?>;
    var quantity = $('#cartQuantity').val();

    $.ajax({
        type: 'post',
        url: 'fetch_Cart.php',
        data: {
            userID: userID,
            quantity: quantity
        },
        success: function(data) {
            var response = JSON.parse(data);

            Swal.fire({
                title: response.success ? 'Added to cart successfully' : 'Error',
                text: response.message,
                icon: response.success ? 'success' : 'error',
                confirmButtonText: 'OK',
                customClass: {
                    container: 'swal-custom-container',
                },
            }).then(function() {
                if (response.success) {
                  
                    $('#AddCart').modal('hide');
                    location.reload();
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




// Load Populated Tour by the system Admins
function loadTours() {
    $.ajax({
        url: 'fetch_tours.php',
        type: 'get',
        dataType: 'json',
        success: function(response) {
            $.each(response, function(index, tour) {
                var tourHtml = `
                <div class="col-md-4 mb-4">
                    <div class="tour-card">
                        <img src="../uploads/${tour['tourimages']}" class="card-img-top" alt="${tour['TourName']}">
                        <div class="card-body">
                            <h5 class="card-title">${tour['TourName']}</h5>
                            <p class="card-text">${tour['tourdescription']}</p>
                            <p class="card-text">Date: ${new Date(tour['date']).toLocaleDateString()}</p>
                            <div class="text-right">
                                <button class="btn btn-primary btn-sm" onclick="$('#cart_id').val(${tour['tourID']}); $('#AddCart').modal('show');">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                                <button class="btn btn-outline-danger btn-sm" onclick="$('#tourID').val(${tour['tourID']}); $('#BookModel').modal('show');">
                                    <i class="fas fa-book"></i> Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('#tour-container').append(tourHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

$(document).ready(function() {
    loadTours();
});




$(document).ready(function() {
    // Populate countries in the modal when it is shown
    $('#BookModel').on('show.bs.modal', function () {
        // Fetch rooms
        $.ajax({
            url: 'fetch_rooms.php', 
            type: 'GET',
            success: function(data) {
                try {
                    var rooms = JSON.parse(data);
                    var roomSelect = $('#roomSelect');
                    roomSelect.empty();
                    roomSelect.append('<option value="">None</option>');
                    rooms.forEach(function(room) {
                        roomSelect.append('<option value="' + room.Room_id + '">' + room.Rooms_Name + '</option>');
                    });
                } catch (e) {
                    Swal.fire('Error', 'Failed to parse room data', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Unable to load room options', 'error');
            }
        });



        
        // Fetch countries
        $.ajax({
            url: 'fetch_countries.php',
            type: 'GET',
            success: function(data) {
                try {
                    var countries = JSON.parse(data);
                    var countrySelect = $('#countrySelect');
                    countrySelect.empty();
                    countrySelect.append('<option value="">Select Country</option>');
                    countries.forEach(function(country) {
                        countrySelect.append('<option value="' + country.country_id + '">' + country.country_name + '</option>');
                    });
                } catch (e) {
                    Swal.fire('Error', 'Failed to parse country data', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Unable to load country options', 'error');
            }
        });
    });
});

  // Fetch and populate tour types
  $.ajax({
        url: 'fetch_tour_types.php', 
        type: 'GET',
        success: function(response) {
            let tourTypes = JSON.parse(response);
            let tourTypeSelect = $('#tourTypeSelect');
            tourTypeSelect.empty();
            $.each(tourTypes, function(index, type) {
                tourTypeSelect.append(`<option value="${type.id}">${type.name}</option>`);
            });
        }
    });



    function bookTour() {
    var formData = $('#bookingForm').serialize(); 

    $.ajax({
        url: 'book_tour.php', 
        type: 'POST',
        data: formData,
        success: function(response) {
            try {
                var result = JSON.parse(response);
                if (result.success) {
                    Swal.fire('Success', 'Your tour has been booked successfully!', 'success')
                    .then(() => {
                        $('#BookModel').modal('hide'); 
                        location.reload(); 
                    });
                } else {
                    Swal.fire('Error', 'Booking failed: ' + result.message, 'error');
                }
            } catch (e) {
                Swal.fire('Error', 'Failed to parse booking response', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'An error occurred while processing your booking.', 'error');
        }
    });
}



// Fetch and populate tour sites based on selected country
$('#countrySelect').change(function() {
    let countryId = $(this).val();
    $.ajax({
        url: 'fetch_tour_sites.php', 
        type: 'POST',
        data: { country_id: countryId },
        success: function(response) {
            let tourSites = JSON.parse(response);
            let tourSiteSelect = $('#tourSiteSelect');
            tourSiteSelect.empty(); // Clear existing options
            $.each(tourSites, function(index, site) {
                tourSiteSelect.append(`<option value="${site.site_id}">${site.site_name}</option>`);
            });
        },
        error: function() {
            console.error('Failed to fetch tour sites.');
        }
    });
});

</script>



















<style>
.tour-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 370px; /* Adjust height as needed */
}

.tour-card img.card-img-top {
    width: 100%;
    height: 150px; 
    object-fit: cover;
}

.tour-card .card-body {
    padding: 15px;
    flex: 1;
}

.tour-card .card-title {
    font-size: 18px;
    margin-bottom: 10px;
}

.tour-card .card-text {
    font-size: 14px;
    margin-bottom: 10px;
}

.text-right {
    margin-top: auto;
    text-align: right;
}

.btn-sm {
    font-size: 12px;
    padding: 5px 10px;
}
</style>


<?php include('../Profile/include/footer.php'); ?>


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


