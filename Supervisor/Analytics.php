<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/navbar.php');
?>


    <div class="container mt-4">
        <h2>Booking Summary Report</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tour Type</th>
                        <th>Total Bookings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>City Tours</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Adventure Tours</td>
                        <td>15</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

    <?php
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>

