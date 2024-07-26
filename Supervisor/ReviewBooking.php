<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/Navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employee Transactions Inventory</h1>
    <p class="mb-4">This table showcases all transactions performed by employees.</p>

    <!-- Search Bar and Download Button -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="input-group-append ml-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fas fa-download"></i> Download
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Export to CSV</a>
                        <a class="dropdown-item" href="#">Export to Excel</a>
                        <a class="dropdown-item" href="#">Export to PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee Transactions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>123</td>
                            <td>Tiger Nixon</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewDetailsModal"><i class="fas fa-eye"></i> View Details</a>
                            </td>
                        </tr>
                        <!-- Repeat similar rows for other transactions -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- View Details Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">Transaction Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="transactionId">Transaction ID</label>
                        <input type="text" class="form-control" id="transactionId" value="1" disabled>
                    </div>
                    <div class="form-group">
                        <label for="employeeId">Employee ID</label>
                        <input type="text" class="form-control" id="employeeId" value="123" disabled>
                    </div>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" value="Tiger Nixon" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="tiger@example.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" value="Edinburgh" disabled>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" value="61" disabled>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" value="$320,800" disabled>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" id="date" value="2011/04/25" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>
