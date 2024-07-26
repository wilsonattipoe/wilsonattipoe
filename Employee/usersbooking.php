<?php
include('../Employee/include/header.php');
include('../Employee/include/navbar.php');
?>








<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tour Customers</h1>
    <p class="mb-4">Tour table to showcase the number of people per their location and the amount they paid for their tours</p>
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

    <!-- Tour Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tour General Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ClientID</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace with PHP loop to fetch data dynamically -->
                        <?php for ($i = 1; $i <= 6; $i++) : ?>
                            <tr>
                                <td>01</td>
                                <td>tiger@example.com</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>$320,800</td>
                                <td>
                                    <?php echo ($i % 2 == 0) ? 'Ongoing' : 'Pending'; ?>
                                </td>
                                <td>2011/04/25</td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-ban"></i> Cancel Booking</a>
                                    <a href="#" class="btn btn-primary btn-sm mb-1 ml-1" data-toggle="modal" data-target="#sendModal"><i class="fas fa-paper-plane"></i>Send Recipt</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
 

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this booking?</p>
                <p><strong>FullName:</strong> Tiger Nixon</p>
                <p><strong>Email:</strong> tiger@example.com</p>
                <p><strong>Location:</strong> Edinburgh</p>
                <p><strong>Phone Number:</strong>61</p>
                <p><strong>Amount:</strong> $320,800</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>






<?php
include('../Employee/include/footer.php');
include('../Employee/include/script.php');
?>
