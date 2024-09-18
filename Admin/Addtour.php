<?php
include('include/header.php');
include('include/navbar.php');

// Database connection
include('../Admin/Database/connect.php'); 

// Query for fetching countries and amounts
$query_countries = 
"SELECT 
    c.`country_name`, 
    c.`continent`, 
    ca.`countryamnt`
FROM 
    `countries` c
JOIN 
    `countryamount` ca 
ON 
    c.`countryamount_id` = ca.`country_id`;";
$result_countries = $conn->query($query_countries);

// Query for fetching tourist sites
$query_sites = 
"SELECT 
    `site_id`, 
    `site_name`
FROM 
    `tourist_sites`;";
$result_sites = $conn->query($query_sites);

// Query for fetching tour statuses
$query_tourstatus = 
"SELECT 
    `tourstat_id`, 
    `tourStatus`
FROM 
    `tourstatus`;";
$result_tourstatus = $conn->query($query_tourstatus);
?>




<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 style="background-color:#32012F; color:white;">Add a Tour</h2>
                </div>
                <div class="card-body">
                    <form id="tourForm"  method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="tourImage">Tour Image:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="file" class="form-control-file flex-grow-1" id="tourImage" name="tourImage" accept="image/*" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tourName">Tour Name:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="text" class="form-control flex-grow-1" id="tourName" name="tourName" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tourDuration">Duration (days):</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="number" class="form-control flex-grow-1" id="tourDuration" name="tourDuration" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tourPersons">Number of Persons:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="number" class="form-control flex-grow-1" id="tourPersons" name="tourPersons" required>
                            </div>
                        </div>

                        <!-- Dropdown for Country and Price -->
                        <div class="form-group">
                            <label for="tourPrice">Country and Price:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <select class="form-control flex-grow-1" id="tourPrice" name="tourPrice" required>
                                    <option value="" disabled selected>Select a country</option>
                                    <?php while($row = $result_countries->fetch_assoc()): ?>
                                        <option value="<?php echo $row['countryamnt']; ?>">
                                            <?php echo $row['country_name'] . ' ($' . $row['countryamnt'] . ')'; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Dropdown for Tourist Site -->
                        <div class="form-group">
                            <label for="tourSite">Tourist Site:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <select class="form-control flex-grow-1" id="tourSite" name="tourSite" required>
                                    <option value="" disabled selected>Select a tourist site</option>
                                    <?php while($row = $result_sites->fetch_assoc()): ?>
                                        <option value="<?php echo $row['site_id']; ?>">
                                            <?php echo $row['site_name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                    <label for="tourstat">Tourist Status:</label>
                    <div class="d-flex justify-content-between align-items-center">
                        <select class="form-control flex-grow-1" id="tourstat" name="tourstat" required>
                            <option value="" disabled selected>Select a tourist status</option>
                            <?php while ($row = $result_tourstatus->fetch_assoc()): ?>
                                <option value="<?php echo $row['tourstat_id']; ?>">
                                    <?php echo htmlspecialchars($row['tourStatus']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>


                        <div class="form-group">
                            <label for="tourDescription">Description:</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <textarea class="form-control flex-grow-1" id="tourDescription" name="tourDescription" rows="4" required></textarea>
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
