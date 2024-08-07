<?php
include('include/header.php');
include('include/navbar.php');

// this is our database connection here
include('../Admin/Database/connect.php'); 

// Fetch prices from the database
$query = 
"SELECT 
    country.country_id, 
    country.country_name, 
    country.continent, 
    countryAmount.countryamount 
FROM 
     country
JOIN 
    countryAmount 
ON 
    country.country_id = countryAmount.country_id;";
$result = $conn->query($query);
?>






<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 style="background-color:#32012F; color:white;">Add a Tour</h2>
                </div>
                <div class="card-body">
                    <form id="tourForm" action="./add_tour.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="tourImage">Tour Image:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="file" class="form-control-file flex-grow-1" id="tourImage" name="tourImage" accept="image/*" required>
                                <button type="button" class="btn btn-outline-primary ml-2">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tourName">Tour Name:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="text" class="form-control flex-grow-1" id="tourName" name="tourName" required>
                                <button type="button" class="btn btn-outline-primary ml-2">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tourDuration">Duration (days):</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="number" class="form-control flex-grow-1" id="tourDuration" name="tourDuration" required>
                                <button type="button" class="btn btn-outline-primary ml-2">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tourPersons">Number of Persons:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="number" class="form-control flex-grow-1" id="tourPersons" name="tourPersons" required>
                                <button type="button" class="btn btn-outline-primary ml-2">Update</button>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="tourPrice">Country and Price:</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <select class="form-control flex-grow-1" id="tourPrice" name="tourPrice" required>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <option value="<?php echo $row['countryamount']; ?>">
                                        <?php echo $row['country_name'] . ' ($' . $row['countryamount'] . ')'; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <button type="button" class="btn btn-outline-primary ml-2">Update</button>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="tourDescription">Description:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <textarea class="form-control flex-grow-1" id="tourDescription" name="tourDescription" rows="4" required></textarea>
                                <button type="button" class="btn btn-outline-primary ml-2">Update</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-block">Add Tour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('tourForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './add_tour.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then(function() {
                        window.location = "../Admin/Addtour.php"; 
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    }).then(function() {
                        window.location = "../Admin/Addtour.php"; 
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error: ' + xhr.status
                }).then(function() {
                    window.location = "../Admin/Addtour.php"; 
                });
            }
        };
        xhr.send(formData);
    });
</script>

<?php
include('include/footer.php');
include('include/script.php');
?>
