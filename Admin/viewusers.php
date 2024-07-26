<?php
include('include/header.php');
include('include/navbar.php');
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

    <!--Tales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tour general table</h6>
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
                        <tr>
                            <td>01</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>Pending</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                                 <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo-alt"></i> Revert Booking
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                       

                        <tr>
                            <td>02</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>Cancel</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                                 <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo-alt"></i> Revert Booking
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                        <tr>
                            <td>03</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>Ongoing</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                                 <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo-alt"></i> Revert Booking
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                        <tr>
                            <td>04</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>Ongoing</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                                 <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo-alt"></i> Revert Booking
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                        <tr>
                            <td>05</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>Pending</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                                 <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo-alt"></i> Revert Booking
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                        <tr>
                            <td>06</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>Pending</td>
                            <td>2011/04/25</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-undo-alt"></i> Revert Booking
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" class="form-control flex-grow-1" id="fullName" value="Tiger Nixon">
                            <button type="button" class="btn btn-primary ml-2">Update</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="email" class="form-control flex-grow-1" id="email" value="tiger@example.com">
                            <button type="button" class="btn btn-primary ml-2">Update</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-control flex-grow-1" id="location">
                                <option value="Edinburgh">Edinburgh</option>
                                <option value="Tokyo">Tokyo</option>
                                <option value="San Francisco">San Francisco</option>
                            </select>
                            <button type="button" class="btn btn-primary ml-2">Update</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" class="form-control flex-grow-1" id="phoneNumber" value="61">
                            <button type="button" class="btn btn-primary ml-2">Update</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="text" class="form-control flex-grow-1" id="amount" value="$320,800">
                            <button type="button" class="btn btn-primary ml-2">Update</button>
                        </div>
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


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
                <p><strong>FullName:</strong> Tiger Nixon</p>
                <p><strong>Email:</strong> tiger@example.com</p>
                <p><strong>Location:</strong> Edinburgh</p>
                <p><strong>Phone Number:</strong> 61</p>
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
include('include/footer.php');
include('include/script.php');
?>







