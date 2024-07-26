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
  <div id="whitelist" class="content-section">
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
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Place Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Placeholder for whitelisted items -->
          <tr>
            <td>HTU campus</td>
            <td>
              <button class="btn btn-success btn-sm"><i class="fas fa-calendar-check"></i> Book Now</button>
              <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Remove</button>
            </td>
          </tr>
        </tbody>
      </table>
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