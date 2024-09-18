<?php
include('include/header.php');
include('include/navbar.php');
include("./Database/connect.php");

// SQL query to fetch bookings with client name, tour type, site name, and action status
$query = "SELECT 
    bt.bookTour_ID, 
    bt.price, 
    cu.FullName AS client_name, 
    cu.Email AS client_email, 
    tt.TourTypeName AS tour_type_name, 
    ts.site_name AS tour_site_name, 
    bt.Dated, 
    a.ActionName AS action_status 
FROM booktours bt
LEFT JOIN clientusers cu ON bt.ClientUserID = cu.ClientUserID
LEFT JOIN tourtypes tt ON bt.tourType_id = tt.TourTypeID
LEFT JOIN tourist_sites ts ON bt.tourSite_id = ts.site_id
LEFT JOIN actions a ON bt.Action_id = a.ActionID";

// Execute the query and store the result
$result = $conn->query($query);

if (!$result) {
    die("Query Failed: " . $conn->error);
}

// Calculate total amount
$total_amount = 0;
while ($row = $result->fetch_assoc()) {
    $total_amount += $row['price'];
}

// Reset the result pointer for table display
$result->data_seek(0);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manage Bookings</h1>
    <p class="mb-4">List of all user bookings for tours.</p>

    <!-- Total Amount Display -->
    <div class="mb-3" style="color:brown;">
        <strong>Total Amount: $<?php echo number_format($total_amount, 2); ?></strong>
    </div>

    <!-- Search Bar -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by client name...">

    <!-- Export Buttons -->
    <div class="mb-3">
        <button class="btn btn-primary" id="exportCsv">Export CSV</button>
        <button class="btn btn-danger" id="exportPdf">Export PDF</button>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="bookingsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Tour Type</th>
                            <th>Tour Site</th>
                            <th>Amount ($)</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['client_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['tour_type_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['tour_site_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['Dated'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <span class="badge 
                                        <?php if ($row['action_status'] == 'Pending') echo 'badge-warning'; ?>
                                        <?php if ($row['action_status'] == 'Ongoing') echo 'badge-primary'; ?>
                                        <?php if ($row['action_status'] == 'Rejected') echo 'badge-danger'; ?>">
                                        <?php echo ucfirst(htmlspecialchars($row['action_status'], ENT_QUOTES, 'UTF-8')); ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal_<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>">View Details</button>

                                    <!-- Email button -->
                                    <button class="btn btn-primary btn-sm send-email" data-id="<?php echo $row['bookTour_ID']; ?>" data-email="<?php echo $row['client_email']; ?>">Send Email</button>

                                    <?php if ($row['action_status'] === 'Pending'): ?>
                                        <button class="btn btn-primary btn-sm change-status" 
                                                data-id="<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                data-action="ongoing">Start
                                        </button>
                                    <?php endif; ?>

                                    <?php if ($row['action_status'] === 'Ongoing'): ?>
                                        <button class="btn btn-warning btn-sm change-status" 
                                                data-id="<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                data-action="Pending">End
                                        </button>
                                    <?php endif; ?>

                                    <button class="btn btn-danger btn-sm change-status" 
                                            data-id="<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>" 
                                            data-action="rejected">Cancel
                                    </button>
                                </td>
                            </tr>
                            <!-- View Modal for Booking Details -->
                            <div class="modal fade" id="viewModal_<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel_<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel_<?php echo htmlspecialchars($row['bookTour_ID'], ENT_QUOTES, 'UTF-8'); ?>">Booking Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Client Name:</strong> <?php echo htmlspecialchars($row['client_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Tour Type:</strong> <?php echo htmlspecialchars($row['tour_type_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Tour Site:</strong> <?php echo htmlspecialchars($row['tour_site_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Amount:</strong> <?php echo htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($row['Dated'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p><strong>Status:</strong> <?php echo ucfirst(htmlspecialchars($row['action_status'], ENT_QUOTES, 'UTF-8')); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
include('include/script.php');
?>

<!-- AJAX and SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.0/papaparse.min.js"></script>

<script>
$(document).ready(function() {
    // Handle status change
    $('.change-status').click(function() {
        var bookingID = $(this).data('id');
        var action = $(this).data('action');

        Swal.fire({
            title: 'Are you sure?',
            text: "Change status to " + action + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'update_booking_action.php',
                    method: 'POST',
                    data: { bookingID: bookingID, action: action },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            let actionMessage;
                            switch(action) {
                                case 'ongoing':
                                    actionMessage = 'Tour started';
                                    break;
                                case 'Pending':
                                    actionMessage = 'Tour ended';
                                    break;
                                case 'rejected':
                                    actionMessage = 'Tour rejected';
                                    break;
                                default:
                                    actionMessage = 'Status updated';
                            }                            Swal.fire({
                                title: 'Success!',
                                text: actionMessage,
                                icon: 'success',
                            }).then(() => {
                                // Reload the page to reflect the changes
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: res.message,
                                icon: 'error',
                            });
                        }
                    }
                });
            }
        });
    });

    // Handle send email
    $('.send-email').click(function() {
        var bookingID = $(this).data('id');
        var clientEmail = $(this).data('email');

        Swal.fire({
            title: 'Are you sure?',
            text: "Send an email to " + clientEmail + "?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, send it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'send_email.php',
                    method: 'POST',
                    data: { bookingID: bookingID, clientEmail: clientEmail },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Email sent successfully.',
                                icon: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: res.message,
                                icon: 'error',
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
