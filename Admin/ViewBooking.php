<?php

include('include/header.php');
include('include/navbar.php');

// Dummy data for demonstration (replace with actual database queries)
$bookings = [
    ['booking_id' => 1, 'user_id' => 'john kwame', 'tour_id' => 'Htu campus', 'amount' => 150.00, 'booking_date' => '2024-06-27', 'status' => 'Active'],
    ['booking_id' => 2, 'user_id' => 'Ama kwamen', 'tour_id' => 'Accra', 'amount' => 200.00, 'booking_date' => '2024-06-28', 'status' => 'Active'],
    ['booking_id' => 3, 'user_id' => 'Tourbook', 'tour_id' => 'Nogogkpo', 'amount' => 250.00, 'booking_date' => '2024-06-29', 'status' => 'Active'],
];

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manage Bookings</h1>
    <p class="mb-4">List of all user bookings for tours.</p>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Clientname</th>
                            <th>Tourname</th>
                            <th>Amount ($)</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo $booking['user_id']; ?></td>
                                <td><?php echo $booking['tour_id']; ?></td>
                                <td><?php echo number_format($booking['amount'], 2); ?></td>
                                <td><?php echo $booking['booking_date']; ?></td>
                                <td><?php echo $booking['status']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm mb-1" data-toggle="modal" data-target="#viewModal_<?php echo $booking['booking_id']; ?>">View Details</a>
                                    <a href="#" class="btn btn-primary btn-sm mb-1 ml-1" data-toggle="modal" data-target="#sendModal"><i class="fas fa-paper-plane"></i> Send</a>
                                    <a href="#" class="btn btn-danger btn-sm mb-1 ml-1" data-toggle="modal" data-target="#cancelModal_<?php echo $booking['booking_id']; ?>">Cancel</a>
                                    <a href="#" class="btn btn-warning btn-sm mb-1 ml-1" data-toggle="modal" data-target="#refundModal_<?php echo $booking['booking_id']; ?>"><i class="fas fa-money-check-alt"></i> Refund</a>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal_<?php echo $booking['booking_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel">Booking Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>User ID:</strong> <?php echo $booking['user_id']; ?></p>
                                            <p><strong>Tour ID:</strong> <?php echo $booking['tour_id']; ?></p>
                                            <p><strong>Amount:</strong> $<?php echo number_format($booking['amount'], 2); ?></p>
                                            <p><strong>Booking Date:</strong> <?php echo $booking['booking_date']; ?></p>
                                            <p><strong>Status:</strong> <?php echo $booking['status']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cancel Modal -->
                            <div class="modal fade" id="cancelModal_<?php echo $booking['booking_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to cancel this booking?</p>
                                            <p><strong>User ID:</strong> <?php echo $booking['user_id']; ?></p>
                                            <p><strong>Tour ID:</strong> <?php echo $booking['tour_id']; ?></p>
                                            <p><strong>Amount:</strong> $<?php echo number_format($booking['amount'], 2); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="#" class="btn btn-danger">Cancel Booking</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Refund Modal -->
                            <div class="modal fade" id="refundModal_<?php echo $booking['booking_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="refundModalLabel">Refund Booking</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="refund_booking.php" method="post">
                                                <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                                                <div class="form-group">
                                                    <label for="refund_amount">Refund Amount ($)</label>
                                                    <input type="number" step="0.01" min="0" class="form-control" id="refund_amount" name="refund_amount" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning">Refund</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
