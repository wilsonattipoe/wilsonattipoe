<?php
include('include/header.php');
include('include/navbar.php');

// Include database connection
include('../Admin/Database/connect.php'); 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 style="background-color:#32012F; color:white;">Add a Room</h2>
                </div>
                <div class="card-body">
                    <form id="roomForm" method="POST" enctype="multipart/form-data">
                        <!-- Room Image -->
                        <div class="form-group">
                            <label for="RoomImage">Room Image:</label>
                            <input type="file" class="form-control-file" id="RoomImage" name="RoomImage" accept="image/*">
                        </div>

                        <!-- Room Amount -->
                        <div class="form-group">
                            <label for="roomAmount">Room Amount:</label>
                            <select class="form-control" id="roomAmount" name="roomAmount">
                                <option value="">Select Room Amount</option>
                                <?php
                                // Fetch room amounts from the database
                                $query = "SELECT `Amount_id`, `Amount` FROM `roomamount`";
                                $result = $conn->query($query);

                                // Populate the dropdown with room amounts
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row['Amount_id'].'">'.$row['Amount'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Room Name -->
                        <div class="form-group">
                            <label for="RoomName">Room Name:</label>
                            <input type="text" class="form-control" id="RoomName" name="RoomName">
                        </div>

                        <!-- Bed Quantity -->
                        <div class="form-group">
                            <label for="bedquantity">Bed Quantity:</label>
                            <input type="number" class="form-control" id="bedquantity" name="bedquantity">
                        </div>

                        <!-- Number of Bathrooms -->
                        <div class="form-group">
                            <label for="bathroom">Number of Bathrooms:</label>
                            <input type="number" class="form-control" id="bathroom" name="bathroom">
                        </div>

                        <!-- WiFi Availability -->
                        <div class="form-group">
                            <label for="wifi">WiFi:</label>
                            <input type="text" class="form-control" id="wifi" name="wifi">
                        </div>

                        <!-- Room Description -->
                        <div class="form-group">
                            <label for="RoomDescription">Description:</label>
                            <textarea class="form-control" id="RoomDescription" name="RoomDescription" rows="4"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-outline-primary btn-block">Add Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('include/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#roomForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Client-side validation
        var roomName = $('#RoomName').val().trim();
        var roomAmount = $('#roomAmount').val().trim();
        var bedQuantity = $('#bedquantity').val().trim();
        var bathroom = $('#bathroom').val().trim();
        var wifi = $('#wifi').val().trim();
        var roomDescription = $('#RoomDescription').val().trim();
        var roomImage = $('#RoomImage').val().trim();

        if (roomName === "" || roomAmount === "" || bedQuantity === "" || bathroom === "" || wifi === "" || roomDescription === "" || roomImage === "") {
            Swal.fire({
                title: "Error",
                text: "Please fill all the required fields.",
                icon: "error"
            });
            return false; // Stop form submission
        }

        // Send AJAX request to PHP
        var formData = new FormData(this);

        $.ajax({
            url: './add_Room.php', 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("Raw response:", response); // Debugging

                try {
                    let data = JSON.parse(response);
                    console.log("Parsed response:", data);

                    if (data.success) {
                        Swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success"
                        });
                        $('#roomForm')[0].reset(); // Reset the form
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: data.message,
                            icon: "error"
                        });
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    Swal.fire({
                        title: "Error",
                        text: "Invalid server response. Please try again.",
                        icon: "error"
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "Something went wrong. Please try again.",
                    icon: "error"
                });
            }
        });
    });
});
</script>
