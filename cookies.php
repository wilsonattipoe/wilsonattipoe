<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./include/navbar.php");
include("./include/header.php");
include("./Database/connect.php");
?>

<style>
    .cookies-header {
      background-color: #f8f9fa;
      padding: 20px;
      border-bottom: 1px solid #e9ecef;
    }
    .cookies-section {
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


<!-- Cookie Policy Content -->
<div class="container cookies-section">
  <div class="row">
    <div class="col-md-12">
      <h2>What are Cookies?</h2>
      <p>Cookies are small text files that are placed on your device to help the site provide a better user experience. In general, cookies are used to retain user preferences, store information for things like shopping carts, and provide anonymized tracking data to third-party applications like Google Analytics.</p>

      <h2>How We Use Cookies</h2>
      <p>We use cookies to understand how you interact with our site, improve your browsing experience, and personalize content and advertisements. Cookies can also help speed up your future interactions with our site and protect your information.</p>
      
      <h2>Types of Cookies We Use</h2>
      <p>Our website uses the following types of cookies:</p>
      <ul>
        <li><strong>Essential Cookies:</strong> These cookies are necessary for the website to function and cannot be switched off in our systems.</li>
        <li><strong>Performance Cookies:</strong> These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site.</li>
        <li><strong>Functional Cookies:</strong> These cookies enable the website to provide enhanced functionality and personalization.</li>
        <li><strong>Targeting Cookies:</strong> These cookies may be set through our site by our advertising partners to build a profile of your interests and show you relevant ads on other sites.</li>
      </ul>
      
      <h2>Managing Cookies</h2>
      <p>You can manage your cookie preferences by adjusting your browser settings. Most web browsers allow you to control cookies through their settings preferences. Please note that disabling cookies may affect the functionality of this and many other websites that you visit.</p>

      <h2>Contact Us</h2>
      <p>If you have any questions or concerns about our use of cookies, please contact us at <a href="mailto:traveltour391@gmail.com">traveltour391@gmail.com</a>.</p>
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

