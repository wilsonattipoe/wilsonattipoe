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

<div id="booking" class="content-section" style="margin: 15px;">
  <h1 class="text-center">Booking</h1>
  <form id="booking-form">

    <div class="form-group">
      <label for="tourName">Tour Name</label>
      <input type="text" class="form-control" id="tourName" placeholder="Select a tour" readonly>
      <button type="button" class="btn btn-primary mt-2" id="selectTourButton">Select Tour</button>
    </div>

    <div class="form-group">
      <label for="selectedRoom">Selected Room</label>
      <input type="text" class="form-control" id="selectedRoom" placeholder="Select a room" readonly>
      <button type="button" class="btn btn-primary mt-2" id="selectRoomButton">Select Room</button>
    </div>

    <div class="form-group">
      <label for="date">Date</label>
      <input type="date" class="form-control" id="date">
    </div>

    <div class="form-group">
      <label for="participants">Participants</label>
      <input type="number" class="form-control" id="participants" placeholder="Number of participants">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>

  </form>

  <h3 class="mt-5">Existing Bookings</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tour Name</th>
          <th>Room</th>
          <th>Date</th>
          <th>Participants</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Placeholder for booking entries -->
        <tr>
          <td>Ghana</td>
          <td>NULL</td>
          <td>2024-07-01</td>
          <td>10</td>
          <td><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Cancel</button></td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

<!-- Tour Selection Modal -->
<div class="modal fade" id="tourModal" tabindex="-1" role="dialog" aria-labelledby="tourModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tourModalLabel">Select a Tour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="form-control" id="tourSelect">
          <option value="" disabled selected>Select a tour</option>
          <optgroup label="Africa">
            <option value="ghana">Ghana</option>
            <option value="kenya">Kenya</option>
            <option value="south_africa">South Africa</option>
          </optgroup>
          <optgroup label="Asia">
            <option value="japan">Japan</option>
            <option value="china">China</option>
            <option value="thailand">Thailand</option>
          </optgroup>
          <optgroup label="Europe">
            <option value="france">France</option>
            <option value="germany">Germany</option>
            <option value="italy">Italy</option>
          </optgroup>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="selectTourButtonModal">Select</button>
      </div>
    </div>
  </div>
</div>

<!-- Room Selection Modal -->
<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="roomModalLabel">Select a Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <!-- Room 1 -->
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room1.jpg" class="card-img-top" alt="Room 1">
            <div class="card-body">
              <p class="card-text">$100 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 1 Bed</p>
              <p class="card-text"><i class="fas fa-bath"></i> Shared Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 1" data-room-price="100">Select</button>
            </div>
          </div>
        </div>
        <!-- Room 2 -->
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room2.jpg" class="card-img-top" alt="Room 2">
            <div class="card-body">
              <p class="card-text">$150 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 1 Bed</p>
              <p class="card-text"><i class="fas fa-bath"></i> Shared Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 2" data-room-price="150">Select</button>
            </div>
          </div>
        </div>
        <!-- Room 3 -->
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room7.jpg" class="card-img-top" alt="Room 3">
            <div class="card-body">
              <p class="card-text">$200 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 2 Beds</p>
              <p class="card-text"><i class="fas fa-bath"></i> Private Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 3" data-room-price="200">Select</button>
            </div>
          </div>
        </div>
        <!-- Room 4 -->
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room2.jpg" class="card-img-top" alt="Room 4">
            <div class="card-body">
              <p class="card-text">$250 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 3 Beds</p>
              <p class="card-text"><i class="fas fa-bath"></i> Private Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 4" data-room-price="250">Select</button>
            </div>
          </div>
        </div>
        <!-- Room 5 -->
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room3.jpg" class="card-img-top" alt="Room 5">
            <div class="card-body">
              <p class="card-text">$200 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 4 Beds</p>
              <p class="card-text"><i class="fas fa-bath"></i> Private Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 5" data-room-price="200">Select</button>
            </div>
          </div>
        </div>

           <!-- Room 6 -->
           <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room3.jpg" class="card-img-top" alt="Room 5">
            <div class="card-body">
              <p class="card-text">$200 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 4 Beds</p>
              <p class="card-text"><i class="fas fa-bath"></i> Private Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 5" data-room-price="200">Select</button>
            </div>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#selectTourButton').click(function() {
      $('#tourModal').modal('show');
    });

    $('#selectTourButtonModal').click(function() {
      var selectedTour = $('#tourSelect').val();
      $('#tourName').val(selectedTour);
      $('#tourModal').modal('hide');
    });

    $('#selectRoomButton').click(function() {
      $('#roomModal').modal('show');
    });

    $('.select-room-btn').click(function() {
      var roomName = $(this).data('room-name');
      var roomPrice = $(this).data('room-price');
      $('#selectedRoom').val(roomName + ' - $' + roomPrice);
      $('#roomModal').modal('hide');
    });
  });
</script>

</body>
</html>






































<!-- <?php
//session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//include('../Profile/include/header.php');
//include('../Profile/include/navbar.php');

//if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
  ////  $username = ucwords($_SESSION['Username']);
  //  $userID = $_SESSION['ClientUserID'];
///}// else {
    // displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    // header("Location: /login.php");
    // exit();
//}
//?> -->
<!-- 
<style>
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        color: black;
    }

    .card-text {
        flex-grow: 1;
    }

    .btn-container {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        margin-top: auto;
        /* Ensures buttons are at the bottom */
    }

    .carousel-inner img {
        height: 100%;
        object-fit: cover;
    }

    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 1,
            'wght' 700,
            'GRAD' 200,
            'opsz' 24;
    }

    .loading {
        display: none;
        text-align: center;
        margin-top: 2rem;
        font-size: 1.5rem;
        color: #666;
    }

    .no-data {
        display: none;
        text-align: center;
        margin-top: 2rem;
        font-size: 1.5rem;
        color: #f00;
    }
</style> -->

<!-- <div class="container" id="Special">
    <div class="loading">Loading...</div>
    <div class="no-data">No data available</div>
    <div class="card" style="width: 70rem; height: 18rem;">
        <div class="row no-gutters" id="cardContent">
          
    </div>
</div>

///<?php
//include "../Profile/include/script.php";
//?> 

<!-- jQuery
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  -->

<!-- <script>
    $(document).ready(function() {
        function fetchCardData() {
            $('.loading').show(); // Show loading indicator
            $('.no-data').hide(); // Hide no data message
            $('#cardContent').empty(); // Clear previous content

            $.ajax({
                type: 'get',
                url: "fetchCardData.php", // Adjust this URL to your endpoint
                success: function(data) {
                    var response = JSON.parse(data);
                    console.log(response);

                    if (response.images.length === 0) {
                        $('.loading').hide();
                        $('.no-data').show();
                        return;
                    }

                    var indicators = '';
                    var items = '';
                    var cardContent = '';

                    for (var i = 0; i < response.images.length; i++) {
                        var isActive = i === 0 ? 'active' : '';
                        indicators += '<li data-target="#carouselExampleIndicators" data-slide-to="' + i + '" class="' + isActive + '"></li>';
                        items += '<div class="carousel-item ' + isActive + '">';
                        items += '<img class="d-block w-100" src="' + response.images[i].image_url + '" alt="' + response.images[i].image_alt + '">';
                        items += '</div>';
                    }

                    cardContent += '<div class="col-md-4">';
                    cardContent += '  <div id="carouselExampleIndicators" class="carousel slide h-100" data-ride="carousel">';
                    cardContent += '    <ol class="carousel-indicators">' + indicators + '</ol>';
                    cardContent += '    <div class="carousel-inner h-100">' + items + '</div>';
                    cardContent += '    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
                    cardContent += '      <span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                    cardContent += '      <span class="sr-only">Previous</span>';
                    cardContent += '    </a>';
                    cardContent += '    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
                    cardContent += '      <span class="carousel-control-next-icon" aria-hidden="true"></span>';
                    cardContent += '      <span class="sr-only">Next</span>';
                    cardContent += '    </a>';
                    cardContent += '  </div>';
                    cardContent += '</div>';

                    cardContent += '<div class="col-md-8">';
                    cardContent += '  <div class="card-body">';
                    cardContent += '    <p class="card-text">' + response.details.text + '</p>';
                    cardContent += '    <div class="btn-container">';
                    cardContent += '      <a href="#" class="btn btn-primary btn-lg" role="button"><span class="material-symbols-outlined">add_shopping_cart</span></a>';
                    cardContent += '      <a href="#" class="btn btn-secondary btn-lg" role="button"><span class="material-symbols-outlined">check</span></a>';
                    cardContent += '    </div>';
                    cardContent += '  </div>';
                    cardContent += '</div>';

                    $('.loading').hide();
                    $('#cardContent').html(cardContent);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('.loading').hide();
                    $('.no-data').show();
                }
            });
        }

        fetchCardData();
    });
</script> -->