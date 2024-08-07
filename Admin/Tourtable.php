<?php
include('include/header.php');
include('include/navbar.php');

// Database connection
include('../Database/connect.php');

// Fetch tour data from the database
$sql = "SELECT 
    tours.TourID, 
    tours.TourTypeID, 
    tours.TourName, 
    tours.tourdescription, 
    tours.Price, 
    tours.tourimages, 
    tours.numberperson, 
    tours.TourDuration, 
    tours.date, 
    country.country_name, 
    countryAmount.countryamount 
FROM 
    tours
JOIN 
    countryAmount 
ON 
    tours.Price = countryAmount.countryamount 
JOIN 
    country 
ON 
    countryAmount.country_id = country.country_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

// Fetch country and amount data for dropdown
$sql_country_amount = "SELECT 
    country.country_name, 
    countryAmount.countryamount 
FROM 
    countryAmount
JOIN 
    country 
ON 
    countryAmount.country_id = country.country_id";
$result_country_amount = $conn->query($sql_country_amount);

if ($result_country_amount->num_rows > 0) {
    $country_amounts = $result_country_amount->fetch_all(MYSQLI_ASSOC);
} else {
    $country_amounts = [];
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
                            <th>TourID</th>
                            <th>Tour Name</th>
                            <th>Number of Days</th>
                            <th>Number of Users</th>
                            <th>Country and Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tour['TourID']); ?></td>
                                <td><?php echo htmlspecialchars($tour['TourName']); ?></td>
                                <td><?php echo htmlspecialchars($tour['TourDuration']); ?></td>
                                <td><?php echo htmlspecialchars($tour['numberperson']); ?></td>
                                <td><?php echo htmlspecialchars($tour['country_name']) . ' ($' . number_format($tour['Price'], 2) . ')'; ?></td>
                                <td><?php echo strlen($tour['tourdescription']) > 50 ? htmlspecialchars(substr($tour['tourdescription'], 0, 50)) . '...' : htmlspecialchars($tour['tourdescription']); ?></td>
                                <td><?php echo date('m/d/Y', strtotime($tour['date'])); ?></td>
                                <td>
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $tour['TourID']; ?>" data-name="<?php echo htmlspecialchars($tour['TourName']); ?>" data-duration="<?php echo htmlspecialchars($tour['TourDuration']); ?>" data-users="<?php echo htmlspecialchars($tour['numberperson']); ?>" data-price="<?php echo number_format($tour['Price'], 2); ?>" data-description="<?php echo htmlspecialchars($tour['tourdescription']); ?>"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $tour['TourID']; ?>" data-name="<?php echo htmlspecialchars($tour['TourName']); ?>" data-description="<?php echo htmlspecialchars($tour['tourdescription']); ?>"><i class="fas fa-trash"></i> Delete</a>
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
                        <label for="editPrice">Country and Amount</label>
                        <select class="form-control" id="editPrice">
                            <?php foreach ($country_amounts as $item): ?>
                                <option value="<?php echo $item['countryamount']; ?>">
                                    <?php echo htmlspecialchars($item['country_name']) . ' ($' . number_format($item['countryamount'], 2) . ')'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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
                <p><strong>Tour ID:</strong> <span id="deleteTourID"></span></p>
                <p><strong>Tour Name:</strong> <span id="deleteTourName"></span></p>
                <p><strong>Description:</strong> <span id="deleteTourDescription"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteTour()">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
include('include/script.php');
?>

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
            users: numberOfUsers,
            price: price,
            description: description
        },
        success: function (response) {
            Swal.fire({
                title: 'Success!',
                text: 'Tour updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Reload the page to reflect changes
                }
            });
        },
        error: function () {
            Swal.fire({
                title: 'Error!',
                text: 'There was an error updating the tour.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}

function deleteTour() {
    var tourID = $('#deleteTourID').text();

    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'delete_tour.php',
                type: 'POST',
                data: { id: tourID },
                success: function (response) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Tour has been deleted.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Reload the page to reflect changes
                        }
                    });
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error deleting the tour.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
}
</script>
