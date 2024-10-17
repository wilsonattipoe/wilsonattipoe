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
    header("Location: /logout.php");
    exit();
}

// Fetch current bookings
$sql_current = "SELECT C.ClientUserID,C.Username,T.TourName,T.Price,S.TourTypeName,B.participants,
                SUM(T.numberperson - B.participants) total_left, A.ActionName,T.end_date,T.start_date 
                FROM `booktours` B
                JOIN tours T ON B.tour_id = T.TourID
                JOIN clientusers C ON B.ClientUserID = C.ClientUserID
                JOIN tourtypes S ON T.tourtype_id = S.TourTypeID
                JOIN actions A ON B.action_id = A.ActionID
                WHERE C.ClientUserID = ? AND T.end_date > CURDATE()";

$stmt_current = $conn->prepare($sql_current);
$stmt_current->bind_param('i', $userID);
$stmt_current->execute();
$result_current = $stmt_current->get_result();

$bookings_current = [];
if ($result_current->num_rows > 0) {
    while ($row = $result_current->fetch_assoc()) {
        $bookings_current[] = $row;
    }
}

// Fetch existing bookings (rejected or ended)
$sql_existing = "SELECT C.ClientUserID,C.Username,T.TourName,T.Price,S.TourTypeName,B.participants,
                SUM(T.numberperson - B.participants) total_left, A.ActionName,T.end_date,T.start_date 
                FROM `booktours` B
                JOIN tours T ON B.tour_id = T.TourID
                JOIN clientusers C ON B.ClientUserID = C.ClientUserID
                JOIN tourtypes S ON T.tourtype_id = S.TourTypeID
                JOIN actions A ON B.action_id = A.ActionID
                WHERE C.ClientUserID = ? AND A.ActionName = 'rejected'";

$stmt_existing = $conn->prepare($sql_existing);
$stmt_existing->bind_param('i', $userID);
$stmt_existing->execute();
$result_existing = $stmt_existing->get_result();

$bookings_existing = [];
if ($result_existing->num_rows > 0) {
    while ($row = $result_existing->fetch_assoc()) {
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
            <!-- Tour details will be loaded here -->
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="BookTour()">Book Tour</button>
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


<!-- Current Bookings -->
<h3 class="mt-5" style="color:green;">Current Bookings</h3>
<div class="table-responsive">
    <table class=" table table-bordered table-striped" id="currentBookingsTable">
        <thead>
            <tr>
                <th>Tour Name</th>
                <th>Tour Type</th>
                <th>Amount</th>
                <th>booked for</th>
                <th>start date</th>
                <th>end date</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="text-center">Loading...</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Existing Bookings -->
<h3 class="mt-5" style="color:red;">Existing Bookings</h3>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="existingBookingsTable">
        <thead>
            <tr>
                <th>Tour Name</th>
                <th>Tour Type</th>
                <th>Amount</th>
                <th>booked for</th>
                <th>start date</th>
                <th>end date</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" class="text-center">Loading...</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    function loadBookings(type, tableID) {
        // Send AJAX request
        fetch(`fetch_bookings.php?type=${type}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector(`#${tableID} tbody`);
                tableBody.innerHTML = ''; // Clear the table body

                if (data.status === 'success' && data.data.length > 0) {
                    // Populate table rows
                    data.data.forEach(booking => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${booking.TourName}</td>
                        <td>${booking.TourTypeName}</td>
                        <td>${booking.bookPrice}</td>
                        <td>${booking.participants}</td>
                        <td>${booking.start_date}</td>
                        <td>${booking.end_date}</td>
                        <td>${booking.ActionName}</td>
                        <td>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#CancellationModal">Request Cancellation</button>
                        </td>
                    `;
                        tableBody.appendChild(row);
                    });
                } else {
                    // No data found
                    const noDataRow = document.createElement('tr');
                    noDataRow.innerHTML = `<td colspan="7" class="text-center">No data available</td>`;
                    tableBody.appendChild(noDataRow);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                const tableBody = document.querySelector(`#${tableID} tbody`);
                tableBody.innerHTML = `<tr><td colspan="7" class="text-center">Failed to load data</td></tr>`;
            });
    }

    // Load bookings when page loads
    document.addEventListener('DOMContentLoaded', function() {
        loadBookings('current', 'currentBookingsTable'); // Fetch current bookings
        loadBookings('existing', 'existingBookingsTable'); // Fetch existing bookings
    });
</script>

<script>
    function BookTour() {
        var tourID = $('#tourID').val();
        var bookingDate = $('#bookingDate').val();
        var participants = $('#participants').val();

        if (bookingDate === '' || participants === '') {
            Swal.fire('Error', 'All fields are required', 'error');
            return;
        }

        $.ajax({
            url: 'book_tour.php',
            method: 'POST',
            data: {
                tourID: tourID,
                bookingDate: bookingDate,
                participants: participants
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                Swal.fire('Error', 'An error occurred while processing your request', 'error');
            }
        });
    }

    function submitCancellation() {
        var tourID = $('#cancelTourID').val();
        var reason = $('#cancellationReason').val();

        if (reason === '') {
            Swal.fire('Error', 'Reason for cancellation is required', 'error');
            return;
        }

        $.ajax({
            url: 'cancel_tour.php',
            method: 'POST',
            data: {
                tourID: tourID,
                reason: reason
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                Swal.fire('Error', 'An error occurred while processing your request', 'error');
            }
        });
    }

    function submitRetrieval() {
        var tourID = $('#retrieveTourID').val();
        var reason = $('#retrievalReason').val();

        if (reason === '') {
            Swal.fire('Error', 'Reason for retrieval is required', 'error');
            return;
        }

        $.ajax({
            url: 'retrieve_tour.php',
            method: 'POST',
            data: {
                tourID: tourID,
                reason: reason
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                Swal.fire('Error', 'An error occurred while processing your request', 'error');
            }
        });
    }
</script>
<style>
    .table-responsive {
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 20px;
    }
</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>