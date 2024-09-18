<?php
session_start();
include("./include/header.php");
include("./include/navbar.php");
// Database connection code
require_once('../Admin/Database/connect.php');





// Check if the user is logged in and has the correct role and status
if (isset($_SESSION['AdminUserID'], $_SESSION['RoleID'], $_SESSION['Username'], $_SESSION['statusID'])) {
    $roleID = $_SESSION['RoleID'];
    $statusID = $_SESSION['statusID'];
    $username = $_SESSION['Username'];

    // Only allow access if the user is an Admin and has an active status
    if ($roleID == 1 && $statusID == 1) {
   
        if (!isset($_SESSION['welcome_message_shown'])) {
            $_SESSION['welcome_message_shown'] = true; 
            displayMessage('Welcome ' . $username, 'You have successfully logged in', 'success');
        }

        // Count function: Counting the total number of items in the database
        $queries = array(
            'Total client' => "SELECT COUNT(ClientUserID) AS count FROM clientusers",
            'Total booktours' => "SELECT COUNT(bookTour_ID) AS count FROM booktours",
        );

                    // Query to get total price
            $sql = "SELECT SUM(price) AS total_price FROM booktours";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch the result
                $row = $result->fetch_assoc();
                $total_price = $row['total_price'];
            } else {
                $total_price = 0;
            }

        // Execute queries and store counts
        $counts = array();
        foreach ($queries as $label => $query) {
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                $counts[$label] = $row['count'];
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }
    } else {
        // Unauthorized access
        displayMessage('Error', 'Unauthorized access.', 'error', '../logout.php');
        // Log out user
        session_unset();
        session_destroy();
        exit();
    }
} else {
    // If session variables are not set, display an error and redirect to login
    displayMessage('Error', 'Session not set.', 'error', '../logout.php');
    // Log out user
    session_unset();
    session_destroy();
    exit();
}


?>



















<!-- /.container-fluid -->
<style>
    .card-metric-purple {
        background-color: #32012F;
    }
 
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h6 class="h2 mb-0 text-gray-600">Welcome,<?php echo $username; ?>,to the Admin Dashboard!</h6>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Travel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-metric-purple shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center ">
                        <div class="col mr-2">
                        <h2><i class="fas fa-users fa-sm text-white-100" style="color: white; ">&nbsp;<?php echo $counts ["Total client"]; ?>
                        </i></h2>
                        <span><i class="fa fa-arrow-up" style="color:white;">Client users</i> </span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300 "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <!-- Revenue Card -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card card-metric-purple shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:white;">&nbsp; <?php echo number_format($total_price, 2); ?></i></h2>
                    <span><i class="fa fa-arrow-up text-white-100" style="color:white;"> Revenue income</i></span>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Bookings Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-metric-purple shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:white;">&nbsp; <?php echo $counts ['Total booktours']; ?></i></h2>
                        <span><i class="fa fa-arrow-up text-white-100"  style="color:white;">Bookings</i></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-metric-purple shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:white;">&nbsp;3</i></h2>
                        <span><i class="fa fa-arrow-up text-white-100"  style="color:white;">User Feedbacks</i></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"  style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Content Row -->




            <!-- Booking chart included here Eli -->
            <?php
            include "../Supervisor/chart.php";
            ?>

  <!-- Recent Bookings Table -->
  <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Amount</th>
                                <th>Tour Type</th>
                            </tr>
                        </thead>
                        <tbody id="bookingTableBody">
                            <!-- Data will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $.ajax({
                url: './fetch_recent_bookings.php', 
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (Array.isArray(data)) {
                        var rows = '';
                        data.forEach(function(booking) {
                            rows += '<tr>' +
                                '<td>' + booking.customerName + '</td>' +
                                '<td>' + booking.customerContact + '</td>' +
                                '<td>$' + booking.amount + '</td>' +
                                '<td>' + booking.tourType + '</td>' +
                                '</tr>';
                        });
                        $('#bookingTableBody').html(rows);
                    } else {
                        console.error('Unexpected data format:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    </script>

       
<?php
include("./include/footer.php");
?>

