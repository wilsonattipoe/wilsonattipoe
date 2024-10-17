<?php
include('include/header.php');
include('include/navbar.php');

// Database connection
include('../Database/connect.php');

// Fetch tour data from the database
$sql = "SELECT 
    TourID, 
    TourName, 
    tourdescription, 
    Price, 
    numberperson, 
    TourDuration, 
    date 
FROM 
    tours";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

$conn->close();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tour Tables</h1>
    <p class="mb-4">Tour table to showcase the Locations and the amount for each tour</p>

    <!-- Search Bar and Download Button -->
    <div class="row mb-3">
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
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
                            <th style="background-color: #32012F;  font-size: 12px; color:white;">TourID</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;" >Tour Name</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;">Number of Days</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;">Number of Users</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;">Price</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;">Description</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;">Date</th>
                            <th style="background-color: #32012F; font-size: 12px;  color:white;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tour['TourID']); ?></td>
                                <td><?php echo htmlspecialchars($tour['TourName']); ?></td>
                                <td><?php echo htmlspecialchars($tour['TourDuration']); ?></td>
                                <td><?php echo htmlspecialchars($tour['numberperson']); ?></td>
                                <td><?php echo number_format($tour['Price'], 2); ?></td>
                                <td><?php echo strlen($tour['tourdescription']) > 50 ? htmlspecialchars(substr($tour['tourdescription'], 0, 50)) . '...' : htmlspecialchars($tour['tourdescription']); ?></td>
                                <td><?php echo date('m/d/Y', strtotime($tour['date'])); ?></td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $tour['TourID']; ?>" data-name="<?php echo htmlspecialchars($tour['TourName']); ?>" data-duration="<?php echo htmlspecialchars($tour['TourDuration']); ?>" data-users="<?php echo htmlspecialchars($tour['numberperson']); ?>" data-price="<?php echo number_format($tour['Price'], 2); ?>" data-description="<?php echo htmlspecialchars($tour['tourdescription']); ?>"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $tour['TourID']; ?>" data-name="<?php echo htmlspecialchars($tour['TourName']); ?>" data-description="<?php echo htmlspecialchars($tour['tourdescription']); ?>"><i class="fas fa-trash"></i> Delete</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
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
                <h5 class="modal-title" id="editModalLabel">Edit Tour Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTourForm">
                    <input type="hidden" id="editTourID">
                    <div class="form-group">
                        <label for="editTourName">Tour Name</label>
                        <input type="text" class="form-control" id="editTourName">
                    </div>
                    <div class="form-group">
                        <label for="editTourDuration">Number of Days</label>
                        <input type="text" class="form-control" id="editTourDuration">
                    </div>
                    <div class="form-group">
                        <label for="editNumberOfUsers">Number of Users</label>
                        <input type="text" class="form-control" id="editNumberOfUsers">
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="text" class="form-control" id="editPrice">
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea class="form-control" id="editDescription"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateTour()">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this tour?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Edit Modal
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var tourID = button.data('id');
        var tourName = button.data('name');
        var tourDuration = button.data('duration');
        var numberOfUsers = button.data('users');
        var price = button.data('price');
        var description = button.data('description');

        var modal = $(this);
        modal.find('#editTourID').val(tourID);
        modal.find('#editTourName').val(tourName);
        modal.find('#editTourDuration').val(tourDuration);
        modal.find('#editNumberOfUsers').val(numberOfUsers);
        modal.find('#editPrice').val(price);
        modal.find('#editDescription').val(description);
    });
});
function updateTour() {
    var tourID = $('#editTourID').val();
    var tourName = $('#editTourName').val();
    var tourDuration = $('#editTourDuration').val();
    var numberOfUsers = $('#editNumberOfUsers').val();
    var price = $('#editPrice').val();
    var description = $('#editDescription').val();

    $.ajax({
        url: 'update_tour.php',
        type: 'POST',
        data: {
            id: tourID,
            name: tourName,
            duration: tourDuration,
            numberperson: numberOfUsers,
            price: price,
            description: description
        },
        dataType: 'json', 
        success: function(response) {
            console.log('Response:', response); 

            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated Successfully',
                    text: 'The tour has been updated successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); 
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: response.message || 'Error updating the tour. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ' - ' + error);
            Swal.fire({
                icon: 'error',
                title: 'AJAX Error',
                text: 'An error occurred during the AJAX request. Please check the console for details.',
                confirmButtonText: 'OK'
            });
        }
    });
}






$(document).ready(function() {
    let tourIdToDelete;

    // Open the modal and set the data
    $('.delete-btn').on('click', function() {
        tourIdToDelete = $(this).data('id'); // Corrected to match the data-id attribute
        $('#deleteTourID').text(tourIdToDelete);
        $('#deleteModal').modal('show');
    });

    // Confirm deletion
    $('#confirmDeleteBtn').on('click', function() {
        console.log('Tour ID to delete:', tourIdToDelete); 

        $.ajax({
            url: 'delete_tour.php',
            type: 'POST',
            data: {
                tour_id: tourIdToDelete
            },
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response); 
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    Swal.fire('Deleted!', 'The tour has been deleted.', 'success');
                    // Optionally reload the page or remove the row from the table
                    location.reload(); // Refresh page to reflect changes
                } else {
                    Swal.fire('Error!', response.message || 'There was an issue deleting the tour.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'An unexpected error occurred.', 'error');
            }
        });
    });
});


</script>