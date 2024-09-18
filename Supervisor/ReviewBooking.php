<?php
include('../Supervisor/include/header.php');
include('../Supervisor/include/Navbar.php');

// Database connection
include("./Database/connect.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inventory</h1>

    <!-- Search Bar and Download Button -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inventory</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="background-color: #0C1844;  font-size: 16px; color:white;">Fullname</th>
                            <th style="background-color: #0C1844;  font-size: 16px; color:white;">Action</th>
                            <th style="background-color: #0C1844;  font-size: 16px; color:white;">Details</th>
                            <th style="background-color: #0C1844;  font-size: 16px; color:white;">Date</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTable">
                        <!-- Data will be loaded here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- jQuery CDN for AJAX handling -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
$(document).ready(function() {
    // Load data on page load
    load_data();

    // Load data based on search query
    $('#search').on('keyup', function() {
        var query = $(this).val();
        load_data(query);
    });

    function load_data(query = '') {
        $.ajax({
            url: "search_transactions.php",
            method: "POST",
            data: {query: query},
            success: function(data) {
                $('#transactionTable').html(data);
            }
        });
    }
});
</script>


<script>
// JavaScript for dynamic search using keyup event
document.querySelector('.form-control').addEventListener('keyup', function() {
    let input = this.value.toLowerCase();
    let tableRows = document.querySelectorAll('#dataTable tbody tr');

    // Loop through each table row
    tableRows.forEach(row => {
        let text = row.textContent.toLowerCase();
        // Show or hide the row based on whether the input matches the text content
        row.style.display = text.includes(input) ? '' : 'none';
    });
});
</script>



<?php
include('../Supervisor/include/footer.php');
include('../Supervisor/include/script.php');
?>
