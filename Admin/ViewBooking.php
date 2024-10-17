<?php
include('include/header.php');
include('include/navbar.php');
include("./Database/connect.php");

// SQL query to fetch bookings with client name, tour type, and action status
$query = "SELECT B.bookTour_ID, C.Username, T.TourName, bookPrice, S.TourTypeName, B.participants, 
                 (T.numberperson - B.participants) as total_left, A.ActionName, T.end_date, T.start_date 
          FROM `booktours` B
          JOIN tours T ON B.tour_id = T.TourID
          JOIN clientusers C ON B.ClientUserID = C.ClientUserID
          JOIN tourtypes S ON T.tourtype_id = S.TourTypeID
          JOIN actions A ON B.action_id = A.ActionID";

// Execute the query and store the result
$result = $conn->query($query);

if (!$result) {
    die("Query Failed: " . $conn->error);
}

// Calculate total amount
$total_amount = 0;
while ($row = $result->fetch_assoc()) {
    $total_amount += $row['bookPrice'];
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
                            <th>Tour Name</th>
                            <th>Tour Type</th>
                            <th>Amount ($)</th>
                            <th>Participants</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['Username']; ?></td>
                                <td><?php echo $row['TourName']; ?></td>
                                <td><?php echo $row['TourTypeName']; ?></td>
                                <td><?php echo $row['bookPrice']; ?></td>
                                <td><?php echo $row['participants']; ?></td>
                                <td>
                                    <span class="badge 
                                    <?php if ($row['ActionName'] == 'Pending') echo 'badge-warning'; ?>
                                    <?php if ($row['ActionName'] == 'Ongoing') echo 'badge-primary'; ?>
                                    <?php if ($row['ActionName'] == 'Rejected') echo 'badge-danger'; ?>">
                                        <?php echo ucfirst($row['ActionName']); ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal_<?php echo $row['bookTour_ID']; ?>">View Details</button>

                                    <?php if ($row['ActionName'] === 'Pending'): ?>
                                        <button class="btn btn-primary btn-sm change-status" data-id="<?php echo $row['bookTour_ID']; ?>" data-action="ongoing">Start</button>
                                    <?php endif; ?>

                                    <?php if ($row['ActionName'] === 'Ongoing'): ?>
                                        <button class="btn btn-warning btn-sm change-status" data-id="<?php echo $row['bookTour_ID']; ?>" data-action="pending">End</button>
                                    <?php endif; ?>

                                    <?php if ($row['ActionName'] === 'Rejected'): ?>
                                        <button class="btn btn-success btn-sm change-status" data-id="<?php echo $row['bookTour_ID']; ?>" data-action="pending">Retrieve</button>
                                    <?php endif; ?>

                                    <button class="btn btn-danger btn-sm change-status" data-id="<?php echo $row['bookTour_ID']; ?>" data-action="rejected">Cancel</button>
                                </td>
                            </tr>

                            <!-- View Modal for Booking Details -->
                            <div class="modal fade" id="viewModal_<?php echo $row['bookTour_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel_<?php echo $row['bookTour_ID']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel_<?php echo $row['bookTour_ID']; ?>">Booking Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Client Name:</strong> <?php echo $row['Username']; ?></p>
                                            <p><strong>Tour Name:</strong> <?php echo $row['TourName']; ?></p>
                                            <p><strong>Tour Type:</strong> <?php echo $row['TourTypeName']; ?></p>
                                            <p><strong>Amount:</strong> $<?php echo number_format($row['Price'], 2); ?></p>
                                            <p><strong>Status:</strong> <?php echo ucfirst($row['ActionName']); ?></p>
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

<!-- JavaScript for Status Change, Search, CSV and PDF Export -->
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
                        data: {
                            bookingID: bookingID,
                            action: action
                        },
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                Swal.fire('Updated!', 'The status has been updated.', 'success').then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('AJAX error: ' + error);
                        }
                    });
                }
            });
        });

        // Dynamic search function
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#bookingsTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Export to CSV
        $("#exportCsv").click(function() {
            var csv = [];
            var rows = document.querySelectorAll("#bookingsTable tr");
            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }
                csv.push(row.join(","));
            }
            var csvFile = new Blob([csv.join("\n")], {
                type: "text/csv"
            });
            var downloadLink = document.createElement("a");
            downloadLink.download = "bookings.csv";
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.click();
        });

        // Export to PDF
        $("#exportPdf").click(function() {
            var {
                jsPDF
            } = window.jspdf;
            var doc = new jsPDF();
            doc.text("Booking Details", 20, 10);
            doc.autoTable({
                html: '#bookingsTable'
            });
            doc.save('bookings.pdf');
        });
    });
</script>