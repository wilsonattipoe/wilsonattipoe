<?php
include('include/header.php');
include('include/navbar.php');

    // Database connection code
require_once('../Admin/Database/connect.php');

// Count function: Counting the total number of items in the database
$queries = array(
    "Total client" => "SELECT COUNT(ClientUserID) AS count FROM clientusers",
);



// Execute queries and store counts
$counts = array();
foreach ($queries as $label => $query) {
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $counts[$label] = $row["count"];
    } else {
        echo "Error executing query: " . $conn->error;
    }
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
        <h1 class="h3 mb-0 ">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Travel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-metric-purple shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center ">
                        <div class="col mr-2">
                        <h2><i class="fas fa-users fa-sm text-white-100" style="color: white; "> &nbsp;&nbsp;<?php echo $counts ["Total client"]; ?>
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
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100"  style="color:white;">&nbsp;24,590</i></h2>
                        <span><i class="fa fa-arrow-up text-white-100"  style="color:white;">Revenue income</i> </span>
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
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:white;">&nbsp;24,590</i></h2>
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
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100" style="color:white;">&nbsp;24,590</i></h2>
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
                                    <th>Booking ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12345</td>
                                    <td>John Doe</td>
                                    <td>$150</td>
                                </tr>
                                <tr>
                                    <td>12346</td>
                                    <td>Jane Smith</td>
                                    <td>$200</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activities</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li>NK booked a tour to Paris on June 20, 2024.</li>
                        <li>ELI requested a refund for her booking on June 18, 2024.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->




       
<?php
include('include/footer.php');
include('include/script.php');
?>
