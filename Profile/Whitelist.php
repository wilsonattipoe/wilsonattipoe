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


<div class="container" id="Special">
 <!-- Whitelist Section -->
 <div id="whitelist" class="content-section container mt-5">
        <h2>Whitelist</h2>
        <form id="whitelist-form">
            <div class="form-group">
                <label for="placeName">Place Name</label>
                <input type="text" class="form-control flex-grow-1" id="placeName" placeholder="Enter place name">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add to Whitelist</button>
        </form>
        <h3 class="mt-5">Whitelisted Places</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="whitelistTable">
                <thead>
                    <tr>
                        <th>Place Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic content will be added here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Remove Confirmation Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeModalLabel">Confirm Removal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="remove-form">
                        <div class="form-group">
                            <label for="removeReason">Reason for Removal</label>
                            <textarea class="form-control" id="removeReason" rows="3" placeholder="Enter reason here"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmRemove" disabled>Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Carousel for tours -->
    <div class="container mt-5">
      <div id="tourCarousel" class="carousel slide" data-ride="carousel">
        <h1 style="text-align: center;">🔥Hot Sale</h1>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="card-deck justify-content-center">
              <div class="card rounded" style="max-width: 200px;">
                <img src="/img/22.jpg" class="card-img-top" alt="Tour 1 Image">
                <div class="card-body p-2">
                  <h6 class="card-title mb-0">Accra</h6>
                  <p class="card-text mb-0">Rating: <i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star-half-alt" style="color:orange"></i></p>
                  <p class="card-text mb-0">Amount: $100</p>
                </div>
              </div>
              <div class="card rounded" style="max-width: 200px;">
                <img src="/img/22.jpg" class="card-img-top" alt="Tour 2 Image">
                <div class="card-body p-2">
                  <h6 class="card-title mb-0">Northern</h6>
                  <p class="card-text mb-0">Rating: <i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i></p>
                  <p class="card-text mb-0">Amount: $150</p>
                </div>
              </div>
              <div class="card rounded" style="max-width: 200px;">
                <img src="/img/22.jpg" class="card-img-top" alt="Tour 3 Image">
                <div class="card-body p-2">
                  <h6 class="card-title mb-0">Volta Region</h6>
                  <p class="card-text mb-0">Rating: <i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i></p>
                  <p class="card-text mb-0">Amount: $120</p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card-deck justify-content-center">
              <div class="card rounded" style="max-width: 200px;">
                <img src="/img/22.jpg" class="card-img-top" alt="Tour 4 Image">
                <div class="card-body p-2">
                  <h6 class="card-title mb-0">Eastern Region</h6>
                  <p class="card-text mb-0">Rating: <i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star-half-alt" style="color:orange"></i></p>
                  <p class="card-text mb-0">Amount: $200</p>
                </div>
              </div>
              <div class="card rounded" style="max-width: 200px;">
                <img src="/img/22.jpg" class="card-img-top" alt="Tour 5 Image">
                <div class="card-body p-2">
                  <h6 class="card-title mb-0">HTU Campus</h6>
                  <p class="card-text mb-0">Rating: <i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="far fa-star" style="color:orange"></i></p>
                  <p class="card-text mb-0">Amount: $180</p>
                </div>
              </div>
              <div class="card rounded" style="max-width: 200px;">
                <img src="/img/22.jpg" class="card-img-top" alt="Tour 6 Image">
                <div class="card-body p-2">
                  <h6 class="card-title mb-0">Your Choice wai</h6>
                  <p class="card-text mb-0">Rating: <i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i><i class="fas fa-star" style="color:orange"></i></p>
                  <p class="card-text mb-0">Amount: $130</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
        </div>
      </div>

    </div>


<?php
include "../Profile/include/script.php";
?>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<script>
$(document).ready(function() {
    // Handle the form submission for adding a place
    $('#whitelist-form').on('submit', function(event) {
        event.preventDefault(); 

        var placeName = $('#placeName').val();

        if (!placeName.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Enter a place',
                text: 'Place name cannot be empty.',
                confirmButtonText: 'OK'
            });
            return;
        }

        
          // Function to add place to the whitelist table 
        $.ajax({
            url: './add_to_whitelist.php', 
            type: 'POST',
            data: { placeName: placeName },
            dataType: 'json', 
            success: function(response) {
                console.log('Add Response:', response); 
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        fetchWhitelist(); 
                        $('#placeName').val(''); 
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Adding Error',
                    text: 'Failed to add place to whitelist. Please try again later.',
                    confirmButtonText: 'OK'
                });
                console.error('Adding Error:', status, error);
            }
        });
    });






    // Fetch and display all places in the whitelist
    function fetchWhitelist() {
        $.ajax({
            url: './fetch_whitelist.php', 
            type: 'GET',
            dataType: 'json', 
            success: function(response) {
                console.log('Fetch Response:', response); 
                var tableBody = $('#whitelistTable tbody');
                tableBody.empty(); 

                if (response.success) {
                    response.places.forEach(function(place) {
                        var row = $('<tr>').append(`
                            <td>${place.place_name}</td>
                            <td><button class="btn btn-danger btn-sm remove-btn" data-id="${place.whitelist_id}">Remove</button></td>
                        `);
                        tableBody.append(row);
                    });

                    // Enable removal button when there are rows
                    $('.remove-btn').on('click', function() {
                        var placeId = $(this).data('id');
                        $('#confirmRemove').data('id', placeId); // Store the place ID in the confirm button
                        $('#removeModal').modal('show'); // this Show the modal as usual Eli
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to fetch whitelist. Please try again later.',
                    confirmButtonText: 'OK'
                });
                console.error('Error:', status, error);
            }
        });
    }
    // Fetch the whitelist when the page loads
    fetchWhitelist();




    // Handle the confirmation of removal
    $('#confirmRemove').on('click', function() {
        var placeId = $(this).data('id');
        var removalReason = $('#removeReason').val();

        if (!removalReason.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Input Error',
                text: 'Please provide a reason for removal.',
                confirmButtonText: 'OK'
            });
            return;
        }

        $.ajax({
            url: './remove_from_whitelist.php', 
            type: 'POST',
            data: {
                placeId: placeId,
                reason_remove: removalReason
            },
            dataType: 'json', 
            success: function(response) {
                console.log('Remove Response:', response); 
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Remove the row from the table
                        $('#whitelistTable').find(`button[data-id="${placeId}"]`).closest('tr').remove();
                        $('#removeModal').modal('hide'); // Hide the modal
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Remove Error',
                    text: 'Failed to remove place from whitelist. Please try again later.',
                    confirmButtonText: 'OK'
                });
                console.error('Remove Error:', status, error);
            }
        });
    });



    
    // Enable/Disable Confirm button based on textarea input
    $('#removeReason').on('input', function() {
        var reason = $(this).val().trim();
        $('#confirmRemove').prop('disabled', !reason);
    });
});
</script>
