<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./include/navbar.php");
include("./include/header.php");
include("./Database/connect.php");
?>

<style>
    .terms-header {
      background-color: #f8f9fa;
      padding: 20px;
      border-bottom: 1px solid #e9ecef;
    }
    .terms-section {
      margin-top: 20px;
    }
    .footer {
      background-color: #343a40;
      color: #ffffff;
      padding: 20px 0;
    }
    .footer a {
      color: #ffffff;
    }
  </style>


<!-- Terms and Conditions Header -->
<div class="terms-header text-center">
  <h1>Terms and Conditions</h1>
  <p>Last updated: July 30, 2024</p>
</div>

<!-- Terms and Conditions Content -->
<div class="container terms-section">
  <div class="row">
    <div class="col-md-12">
      <h2>Introduction</h2>
      <p>Welcome to our travel and tour website. These terms and conditions outline the rules and regulations for the use of our website.</p>
      
      <h2>Intellectual Property Rights</h2>
      <p>Unless otherwise stated, we own the intellectual property rights for all material on this website. All intellectual property rights are reserved.</p>
      
      <h2>Restrictions</h2>
      <p>You are specifically restricted from the following:</p>
      <ul>
        <li>Publishing any website material in any other media without prior consent.</li>
        <li>Selling, sublicensing, and/or otherwise commercializing any website material.</li>
        <li>Using this website in any way that is damaging or that may be damaging to the website.</li>
      </ul>
      
      <h2>Your Privacy</h2>
      <p>Please read our <a href="./Policy.php">Privacy Policy</a>.</p>
      
      <h2>Limitation of Liability</h2>
      <p>In no event shall we, nor any of our officers, directors, and employees, be held liable for anything arising out of or in any way connected with your use of this website.</p>
      
      <h2>Indemnification</h2>
      <p>You hereby indemnify to the fullest extent us from and against any and all liabilities, costs, demands, causes of action, damages, and expenses arising in any way related to your breach of any of the provisions of these terms.</p>
      
      <h2>Variation of Terms</h2>
      <p>We are permitted to revise these terms at any time as we see fit, and by using this website you are expected to review these terms on a regular basis.</p>
      
      <h2>Contact Information</h2>
      <p>If you have any questions about these terms, please contact us at <a href="mailto:traveltour391@gmail.com">traveltour391@gmail.com</a>.</p>
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

