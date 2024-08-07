<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../Profile/include/header.php');
include('../Profile/include/navbar.php');

// Check if session variables are set
if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $userID = $_SESSION['ClientUserID'];
} else {
    displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    header("Location: /logout.php");
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


 <!-- Current Bookings -->
<h3 class="mt-5">Current Bookings</h3>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tour Name</th>
        <th>Amount GHC:</th>
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
        <td>GHC:100.00</td>
        <td>NULL</td>
        <td>2024-07-01</td>
        <td>10</td>
        <td>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#feedbackModal">
          <i class="fas fa-comments"></i> Feedback
        </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="feedbackModalLabel">Provide Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="feedbackMessage">Your Feedback</label>
            <textarea class="form-control" id="feedbackMessage" rows="3" placeholder="Enter your feedback here"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<h3 class="mt-5">Existing Bookings</h3>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tour Name</th>
        <th>Amount GHC:</th>
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
        <td>GHC:100.00</td>
        <td>NULL</td>
        <td>2024-07-01</td>
        <td>10</td>
        <td>
          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelModal">
            <i class="fas fa-trash"></i> Cancel
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="cancelForm">
          <div class="form-group">
            <label for="cancellationReason">Reason for Cancellation</label>
            <textarea class="form-control" id="cancellationReason" rows="3" placeholder="Enter your reason here" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-danger">Submit Cancellation</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
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
          <!-- Options will be populated by JavaScript -->
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
              <p class="card-text"><i class="fas fa-bed"></i> Breakfast</p>
              <p class="card-text"><i class="fas fa-bath"></i> Private Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 5" data-room-price="200">Select</button>
            </div>
          </div>
        </div>
        <!-- Room 6 -->
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="/img/room3.jpg" class="card-img-top" alt="Room 6">
            <div class="card-body">
              <p class="card-text">$200 per night</p>
              <p class="card-text"><i class="fas fa-wifi"></i> WiFi</p>
              <p class="card-text"><i class="fas fa-bed"></i> 4 Beds</p>
              <p class="card-text"><i class="fas fa-bed"></i> Breakfast</p>
              <p class="card-text"><i class="fas fa-bath"></i> Private Bathroom</p>
              <button type="button" class="btn btn-primary select-room-btn" data-room-name="Room 6" data-room-price="200">Select</button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#selectTourButton').click(function() {
      $('#tourModal').modal('show');
      fetchCountries();
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


    // Function to fetch our countries from the db
    function fetchCountries() {
      $.ajax({
    url: './fetch_countries.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
  
      let tourSelect = $('#tourSelect');
      tourSelect.empty(); 
      tourSelect.append('<option value="" disabled selected>Select a tour</option>');

      let continents = {};

      data.forEach(function(country) {
        if (!continents[country.continent]) {
          continents[country.continent] = [];
        }
        continents[country.continent].push(country.country_name);
      });

      for (let continent in continents) {
        let optgroup = $('<optgroup>').attr('label', continent);
        continents[continent].forEach(function(country) {
          optgroup.append($('<option>').val(country.toLowerCase()).text(country));
        });
        tourSelect.append(optgroup);
      }
    },
    error: function(err) {
      console.error('Error fetching countries:', err);
    }
  });
    }
  });
</script>


