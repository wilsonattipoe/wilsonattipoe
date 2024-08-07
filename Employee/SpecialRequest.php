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
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Customer</th>
                            <th>Title</th>
                            <th>Tour Name</th>
                            <th>Date Submitted</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="requestTableBody">
                        <?php
                        include('./Database/connect.php'); 
                        // Updated SQL query
                        $sql = "SELECT 
                                    r.Request_id, 
                                    r.ClientUserID, 
                                    cu.Username, 
                                    r.ActionID, 
                                    r.Request_title, 
                                    r.Request_description, 
                                    r.Request_tourname, 
                                    r.Request_Date 
                                FROM 
                                    request r 
                                JOIN 
                                    clientusers cu 
                                ON 
                                    r.ClientUserID = cu.ClientUserID";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["Request_id"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Request_title"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Request_tourname"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Request_Date"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Request_description"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["ActionID"]) . "</td>";
                                echo "<td>
                                        <button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#viewRequestModal' data-id='" . $row['Request_id'] . "'>View</button>
                                        <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editRequestModal' data-id='" . $row['Request_id'] . "'>Edit</button>
                                        <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteRequestModal' data-id='" . $row['Request_id'] . "'>Delete</button>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No requests found</td></tr>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                <!-- Content will be loaded here -->
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
                    <!-- Form content will be loaded here -->
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

<?php
include('../Employee/include/footer.php');
include('../Employee/include/script.php');
?>


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
