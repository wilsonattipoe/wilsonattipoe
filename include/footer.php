<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include("./Database/connect.php");
$isLoggedIn = isset($_SESSION['ClientUserID']);
?>



<style>
    .payment-icons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .payment-icons img {
        height: 40px;
        width: auto;
    }

    .payment-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .payment-form .form-label {
        font-weight: bold;
    }

    .payment-form .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
    }

    .payment-form .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .payment-form .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 10px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>





<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Company</h4>
                <a class="btn btn-link" href="/about.php">About Us</a>
                <a class="btn btn-link" href="/contact.php">Contact Us</a>
                <a class="btn btn-link" href="/Policy.php">Privacy Policy</a>
                <a class="btn btn-link" href="/Terms.php">Terms & Condition</a>
                <a class="btn btn-link" href="/FAQ.php">FAQs & Help</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Contact</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Ghana, Accra</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0598751009</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>traveltour391@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <h4 class="text-white mb-3" style="margin-left: 35%;">Payment Channels</h4>
                <div class="payment-icons">
                    <a href="#" class="payment-link"><img src="/img/VISA-logo.png" alt="Visa"></a>
                    <a href="#" class="payment-link"><img src="/img/mastercard.png" alt="MasterCard"></a>
                    <a href="#" class="payment-link"><img src="/img/paypal.png" alt="PayPal"></a>
                    <a href="#" class="payment-link"><img src="/img/express.png" alt="American Express"></a>
                    <a href="#" class="payment-link"><img src="/img/pay.png" alt="Apple Pay"></a>
                    <a href="#" class="payment-link"><img src="/img/rupay.png" alt="RuPay"></a>
                    <a href="#" class="payment-link"><img src="/img/mtn.jpg" alt="MTN"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <!-- Footer date here -->
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="/index.php">Home</a>
                        <a href="/cookies.php">Cookies</a>
                        <a href="/FAQ.php">FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Payment Modal Start -->
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="payment-form bg-light p-4 rounded" method="POST" action="ProcessPayment.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name on Card</label>
                <input type="text" class="form-control" id="name" placeholder="Travel&Tour" required>
            </div>
            <div class="mb-3">
                <label for="card-number" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="card-number" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="expiry-date" class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry-date" placeholder="MM/YY" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="123" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Payment</button>
        </form>
    </div>
</div>
<!-- Payment Modal End -->

<!-- Login Prompt Modal -->
<div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true" style="z-index:1050; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginPromptModalLabel">Please Log In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You need to log in before you can access the payment channels. Please log in to your account or create a new account to continue.</p>
                <a href="/login.php" class="btn btn-primary">Log In</a>
                <a href="/signup.php" class="btn btn-secondary">Sign Up</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<script>
// Get the modals
var paymentModal = document.getElementById("paymentModal");
var loginPromptModal = new bootstrap.Modal(document.getElementById('loginPromptModal'));

// Get the <span> element that closes the payment modal
var span = document.getElementsByClassName("close")[0];

// Get all payment option links
var paymentLinks = document.querySelectorAll('.payment-link');

// Loop through the payment links to add click event listeners
paymentLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        <?php if ($isLoggedIn): ?>
            paymentModal.style.display = "block";
        <?php else: ?>
            loginPromptModal.show();
        <?php endif; ?>
    });
});

// When the user clicks on <span> (x), close the payment modal
span.onclick = function() {
    paymentModal.style.display = "none";
}

// When the user clicks anywhere outside of the payment modal, close it
window.onclick = function(event) {
    if (event.target == paymentModal) {
        paymentModal.style.display = "none";
    }
}
</script>