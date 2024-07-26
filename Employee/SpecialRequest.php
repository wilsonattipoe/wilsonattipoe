<?php
include('../Employee/include/header.php');
include('../Employee/include/navbar.php');
?>



<div class="container">
        <h1 class="mt-4 mb-4">Employee Dashboard - Special Requests</h1>

        <!-- List of Submitted Requests -->
        <div class="card request-list">
            <div class="card-header">
                Submitted Requests
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Customer ID</th>
                            <th>Title</th>
                            <th>Tour Name</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="requestTableBody">
                        <!-- Requests will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>


<?php
include('../Employee/include/footer.php');
include('../Employee/include/script.php');
?>


<style>
        .form-container {
            max-width: 600px;
            margin: 20px auto;
        }

        .request-list {
            margin-top: 20px;
        }
    </style>