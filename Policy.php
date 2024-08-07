<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./include/navbar.php");
include("./include/header.php");
include("./Database/connect.php");
?>


<style>
    .policy-header {
      background-color: #f8f9fa;
      padding: 20px;
      border-bottom: 1px solid #e9ecef;
    }
    .policy-section {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<!-- Policy Header -->
<div class="policy-header text-center">
  <h1>Travel and Tour Policy</h1>
  <p>Last updated: July 30, 2024</p>
</div>

<!-- Policy Content -->
<div class="container policy-section">
  <div class="row">
    <div class="col-md-12">
      <h2>Introduction</h2>
      <p>Welcome to our travel and tour website. We are committed to providing you with the best experience possible. Please read our policy carefully.</p>
      
      <h2>Booking Policy</h2>
      <p>All bookings must be made at least 48 hours in advance. Cancellations made within 24 hours of the scheduled tour will incur a cancellation fee.</p>
      
      <h2>Payment Policy</h2>
      <p>We accept all major credit cards and online payment methods. Full payment is required at the time of booking.</p>
      
      <h2>Refund Policy</h2>
      <p>Refunds will be processed within 7-10 business days. No refunds will be issued for cancellations made within 24 hours of the tour.</p>
      
      <h2>Privacy Policy</h2>
      <p>We respect your privacy and are committed to protecting your personal information. Please refer to our Privacy Policy page for more details.</p>
      
      <h2>Contact Us</h2>
      <p>If you have any questions or concerns, please contact us at <a href="mailto:traveltour391@gmail.com">traveltour391@gmail.com</a>.</p>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>









<?php
    include("./scripts/scriptsLinks.php");
    include("./include/footer.php");
    ?>

