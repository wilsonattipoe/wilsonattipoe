<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../Profile/include/header.php');
include('../Profile/include/navbar.php');

if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $userID = $_SESSION['ClientUserID'];
} else {
    displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    header("Location: /login.php");
    exit();
}
?>

<!-- Employee Special Requests Page -->
<div class="container" id="Special">
    <h1>Special Requests</h1>

    <!-- Form for submitting a new request -->
    <form id="requestForm">
    <div class="form-group">
        <label for="requestTitle">Title</label>
        <input type="text" class="form-control" id="requestTitle" placeholder="Enter request title" required>
    </div>
    <div class="form-group">
        <label for="requestDescription">Description</label>
        <textarea class="form-control" id="requestDescription" rows="3" placeholder="Enter request description"></textarea>
    </div>
    <div class="form-group">
        <label for="tourName">Tour Name</label>
        <input type="text" class="form-control" id="tourName" placeholder="Enter tour name">
    </div>
    <div class="form-group">
        <label for="requestDate">Date</label>
        <input type="date" class="form-control" id="requestDate">
    </div>
    <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>


    <hr>

    <!-- List of submitted requests -->
    <h2>Submitted Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Title</th>
                <th>Tour Name</th>
                <th>Date Submitted</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal">Edit</button>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="editRequestTitle">Title</label>
                        <input type="text" class="form-control" id="editRequestTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="editRequestDescription">Description</label>
                        <textarea class="form-control" id="editRequestDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editTourName">Tour Name</label>
                        <input type="text" class="form-control" id="editTourName">
                    </div>
                    <div class="form-group">
                        <label for="editRequestDate">Date</label>
                        <input type="date" class="form-control" id="editRequestDate">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this request?</p>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php
include "../Profile/include/script.php";
?>





<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<!-- Ajax code for posting the submitted request -->
<script>

$(document).ready(function() {
    function postRequest(event) {
        event.preventDefault();

        const requestData = {
            title: $('#requestTitle').val(),
            description: $('#requestDescription').val(),
            tourName: $('#tourName').val(),
            date: $('#requestDate').val()
        };

        $.ajax({
            url: './submit_request.php',
            method: 'POST',
            data: requestData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    swal({
                        title: "Success",
                        text: "Request submitted successfully.",
                        icon: "success"
                    }).then(() => {
                        $('#requestForm')[0].reset();
                        fetchRequests();
                    });
                } else {
                    swal("Error", response.error, "error");
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                swal("Error", "An error occurred while submitting the request.", "error");
            }
        });
    }

    function fetchRequests() {
        $.ajax({
            url: './fetch_requests.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    console.error("Fetch error:", data.error);
                } else {
                    let rows = '';
                    data.requests.forEach(request => {
                        rows += `
                            <tr>
                                <td>${request.Request_id}</td>
                                <td>${request.Request_title}</td>
                                <td>${request.Request_tourname}</td>
                                <td>${request.Request_Date}</td>
                                <td>${request.ActionName}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" data-id="${request.Request_id}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="${request.Request_id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('table tbody').html(rows);
                }
            },
            error: function(error) {
                console.error('Error fetching requests:', error);
            }
        });
    }

    $('#requestForm').submit(postRequest);
    fetchRequests();
});

</script>
