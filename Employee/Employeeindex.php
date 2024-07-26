<?php
include('../Employee/include/header.php');
include('../Employee/include/navbar.php');

?>


<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- Content Row -->
    <div class="row">

        <!-- Travel Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <h2>Users<br><i class="fas fa-users fa-sm text-white-100"></i>&nbsp;24,590</h2>
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
                        <h2>Revenue<br><i class="fas fa-money-check-alt fa-sm text-white-100"></i>&nbsp;24,590</h2>
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
                        <h2>Bookings<br><i class="fas fa-clipboard-list fa-sm text-white-100"></i>&nbsp;24,590</h2>
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
                        <h2>Inovices<br><i class="fas fa-comments fa-sm text-white-100"></i>&nbsp;24,590</h2>
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


</div>
<!-- /.container-fluid -->



 

 

<?php
include('../Employee/include/footer.php');
include('../Employee/include/script.php');

?>


