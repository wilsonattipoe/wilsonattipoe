<?php
include("./include/navbar.php");
include("./include/header.php");
include('./Database/connect.php');

// Fetch prices from the database
// $query = 
// "SELECT 
//     country.country_id, 
//     country.country_name, 
//     country.continent, 
//     countryAmount.countryamount 
// FROM 
//      country
// JOIN 
//     countryAmount 
// ON 
//     country.country_id = countryAmount.country_id;";
// $result = $conn->query($query);
?>




<!-- Process Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Process</h6>
            <h1 class="mb-5">3 Easy Steps</h1>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-globe fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Choose A Destination</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Choose your desired travel destination from a wide range of options available worldwide.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-dollar-sign fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Pay Online</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Make secure online payments using our easy-to-use payment gateway, ensuring hassle-free transactions.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-plane fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Travel Today</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Embark on your journey today and enjoy a seamless travel experience with our efficient travel services.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Process End -->


<!-- Booking Section Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="booking p-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 text-white">
                    <h6 class="text-white text-uppercase">Booking</h6>
                    <h1 class="text-white mb-4">Online Booking</h1>
                    <p class="mb-4">Welcome to our online booking service. Book your next adventure with ease!</p>
                    <p class="mb-4">Fill out the form below to secure your spot. We look forward to hosting you!</p>
                </div>
                <div class="col-md-6">
                    <h1 class="text-white mb-4">Book A Tour</h1>
                    <form id="paymentForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-transparent" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-transparent" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                         
                            <div class="col-md-6">
                                <div class="form-floating">
                                <select class="form-select bg-transparent" id="destination" name="destination">
                               
                            </select>


                                    <label for="destination">Destination</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-transparent" id="rooms">
                                        <option value="1">Room 1</option>
                                        <option value="2">Room 2</option>
                                        <option value="3">Room 3</option>
                                    </select>
                                    <label for="rooms">Rooms</label>
                                </div>
                            </div>

                            <div class="form-submit" style="display: flex; justify-content: center; margin: 0;">
                                <button type="submit" class="btn btn-outline-light py-3 px-5 mt-2">Book Now</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking Section End -->




<!-- Paystack Integration Script -->
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="API/payment.js"></script> 


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
    include("./scripts/scriptsLinks.php");
    include("./include/footer.php");
    ?>
