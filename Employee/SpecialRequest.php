<?php
include('../Employee/include/header.php');
include('../Employee/include/navbar.php');

include('./Database/connect.php'); 
?>



<div class="container">
    <h1 class="mt-4 mb-4">Employee Dashboard - Special Requests</h1>

    <!-- Search Bar and Download Buttons -->
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="searchBar" class="form-control w-50" placeholder="Search requests...">
        <div>
            <button class="btn btn-outline-primary" onclick="downloadPDF()">
                <i class="fas fa-file-pdf"></i> Download PDF
            </button>
            <button class="btn btn-outline-success" onclick="downloadCSV()">
                <i class="fas fa-file-csv"></i> Download CSV
            </button>
        </div>
    </div>

    <!-- List of Submitted Requests -->
    <div class="card request-list">
        <div class="card-header">
            Submitted Requests
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" style="width: 150%; margin: auto;">
                    <thead>
                        <tr>
                            <th style="background-color:#5cb85c; color:white;">Customer</th>
                            <th style="background-color:#5cb85c; color:white;">Title</th>
                            <th style="background-color:#5cb85c; color:white;">Tour Name</th>
                            <th style="background-color:#5cb85c; color:white;">Date Submitted</th>
                            <th style="background-color:#5cb85c; color:white;">Description</th>
                            <th style="background-color:#5cb85c; color:white;">Status</th>
                            <th style="background-color:#5cb85c; color:white;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="requestTableBody">
                        <?php
                        include('./Database/connect.php'); 
                        $sql = "SELECT 
                                    r.Request_id, 
                                    r.ClientUserID, 
                                    cu.Username, 
                                    A.ActionName, 
                                    r.Request_title, 
                                    r.Request_description, 
                                    r.Request_tourname, 
                                    r.Request_Date 
                                FROM 
                                    request r 
                                JOIN clientusers cu ON r.ClientUserID = cu.ClientUserID
                                JOIN actions A on r.ActionID = A.ActionID";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Truncate text for display
                                $truncatedTitle = strlen($row["Request_title"]) > 20 ? substr($row["Request_title"], 0, 20) . '...' : $row["Request_title"];
                                $truncatedTourName = strlen($row["Request_tourname"]) > 20 ? substr($row["Request_tourname"], 0, 20) . '...' : $row["Request_tourname"];
                                $truncatedDescription = strlen($row["Request_description"]) > 30 ? substr($row["Request_description"], 0, 30) . '...' : $row["Request_description"];

                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
                                echo "<td>" . htmlspecialchars($truncatedTitle) . "</td>";
                                echo "<td>" . htmlspecialchars($truncatedTourName) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Request_Date"]) . "</td>";
                                echo "<td>" . htmlspecialchars($truncatedDescription) . "</td>";
                                echo "<td>" . htmlspecialchars($row["ActionName"]) . "</td>";
                                echo "<td>
                                        <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#viewRequestModal' data-id='" . $row['Request_id'] . "'><i class='fas fa-eye'></i></button>
                                        <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editRequestModal' data-id='" . $row['Request_id'] . "'><i class='fas fa-edit'></i></button>
                                        <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteRequestModal' data-id='" . $row['Request_id'] . "'><i class='fas fa-trash-alt'></i></button>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No requests found</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- View Request Modal -->
<div class="modal fade" id="viewRequestModal" tabindex="-1" role="dialog" aria-labelledby="viewRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRequestModalLabel">View Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Full text content will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Request Modal -->
<div class="modal fade" id="editRequestModal" tabindex="-1" role="dialog" aria-labelledby="editRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRequestModalLabel">Edit Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editRequestForm" method="post" action="edit_request.php">
                <div class="modal-body">
                    <!-- Full text content will be loaded here via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Request Modal -->
<div class="modal fade" id="deleteRequestModal" tabindex="-1" role="dialog" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRequestModalLabel">Delete Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this request?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteRequestForm" method="post" action="delete_request.php">
                    <input type="hidden" id="deleteRequestId" name="request_id" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- JavaScript for dynamic search -->
<script>
    document.getElementById('searchBar').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var tableRows = document.getElementById('requestTableBody').getElementsByTagName('tr');

        Array.from(tableRows).forEach(function(row) {
            var rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(input) ? '' : 'none';
        });
    });

    function downloadPDF() {
        // Implementation for PDF download
    }

    function downloadCSV() {
        // Implementation for CSV download
    }


</script>

<style>
    .table {
    width: 20%; 
}

.table th, .table td {
    white-space: nowrap; 
}

.table .btn {
    margin-right: 2px; 
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // View Request Modal
    $('#viewRequestModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var requestId = button.data('id'); // Extract info from data-* attributes

        // Make an AJAX request to fetch the request details
        $.ajax({
            url: 'view_request.php', 
            type: 'GET',
            data: { id: requestId },
            success: function(data) {
                $('#viewRequestModal .modal-body').html(data);
            }
        });
    });

    // Edit Request Modal
    $('#editRequestModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var requestId = button.data('id');

        // Make an AJAX request to fetch the request details
        $.ajax({
            url: 'edit_request.php', 
            type: 'GET',
            data: { id: requestId },
            success: function(data) {
                $('#editRequestModal .modal-body').html(data);
                $('#editRequestForm').attr('action', 'edit_request.php?id=' + requestId);
            }
        });
    });

    // Delete Request Modal
    $('#deleteRequestModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var requestId = button.data('id');
        $('#deleteRequestId').val(requestId);
    });
});
</script>
<?php
include('../Employee/include/footer.php');
include('../Employee/include/script.php');
?>