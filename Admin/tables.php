<?php
include('include/header.php');
include('include/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tour Tables</h1>
    <p class="mb-4">Tour table to showcase the number of people per their location and the amount they paid for their tours</p>

    <!-- Search Bar -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tour general table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>FullName</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>FullName</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Phone Number</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>tiger@example.com</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                            <td>2011/04/25</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>garrett@example.com</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>$170,750</td>
                            <td>2011/07/25</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>ashton@example.com</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>$86,000</td>
                            <td>2009/01/12</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>cedric@example.com</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>$433,060</td>
                            <td>2012/03/29</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
include('include/footer.php');
include('include/script.php');
?>
