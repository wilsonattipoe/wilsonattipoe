<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-32012F">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Travel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100"></i>&nbsp;24,590</h2>
                        <span><i class="fa fa-arrow-up"></i> +12.07%</span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100"></i>&nbsp;24,590</h2>
                        <span><i class="fa fa-arrow-up"></i> +12.07%</span>
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100"></i>&nbsp;24,590</h2>
                        <span><i class="fa fa-arrow-up"></i> +12.07%</span>
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
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2><i class="fas fa-money-check-alt fa-sm text-white-100"></i>&nbsp;24,590</h2>
                        <span><i class="fa fa-arrow-up"></i> +12.07%</span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                        <li>John Doe booked a tour to Paris on June 20, 2024.</li>
                        <li>Jane Smith requested a refund for her booking on June 18, 2024.</li>
                        <!-- Add more activities as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<?php
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>


<!-- Generate report button styling -->
<style>
    .btn-32012F {
        background-color: #0C1844;
        border-color: #0C1844;
    }
</style>
