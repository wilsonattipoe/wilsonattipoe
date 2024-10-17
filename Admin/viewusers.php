<body>
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
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
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
                            <a class="dropdown-item" href="export_csv.php" id="exportCSV">Export to CSV</a>
                            <a class="dropdown-item" href="export_pdf.php" id="exportPDF">Export to PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tour General Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody id="bookingTableBody">
                            <!-- Data will be inserted here-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <?php
        include('include/footer.php');
        include('include/script.php');
        ?>

        <script>
            $(document).ready(function() {
                // Fetch data from the server
                $.ajax({
                    url: 'fetch_tour_customers.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (Array.isArray(data)) {
                            var rows = '';
                            data.forEach(function(booking) {
                                rows += '<tr>' +
                                    '<td>' + booking.FullName + '</td>' +
                                    '<td>' + booking.Email + '</td>' +
                                    '<td>' + booking.contact + '</td>' +
                                    '<td>' + booking.location + '</td>';
                            });
                            $('#bookingTableBody').html(rows);
                            $('#dataTable').DataTable(); // Initialize DataTables
                        } else {
                            console.error('Unexpected data format:', data);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });

                // Search functionality
                $('#searchInput').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('#bookingTableBody tr').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                });
            });
        </script>