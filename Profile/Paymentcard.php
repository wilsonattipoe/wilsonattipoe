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

  <!-- Payment Method Section -->
  <div id="payment" class="content-section">
    <h2>Payment Method</h2>
    <form id="payment-form">
      <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <input type="text" class="form-control flex-grow-1" id="cardNumber" placeholder="Enter card number">
      </div>
      <div class="form-group">
        <label for="cardHolder">Card Holder</label>
        <input type="text" class="form-control flex-grow-1" id="cardHolder" placeholder="Enter card holder name">
      </div>
      <div class="form-group">
        <label for="expiryDate">Expiry Date</label>
        <input type="month" class="form-control flex-grow-1" id="expiryDate">
      </div>
      <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control flex-grow-1" id="cvv" placeholder="Enter CVV">
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add Payment Method</button>
    </form>
    <h3 class="mt-5">Existing Payment Methods</h3>
    <ul class="list-group">
      <!-- Placeholder for payment methods -->
      <li class="list-group-item">
        <span>Card ending in 1234</span>
        <button class="btn btn-danger btn-sm float-right"><i class="fas fa-trash"></i> Remove</button>
      </li>
    </ul>
  </div>
</div>


<?php
include "../Profile/include/script.php";
?>