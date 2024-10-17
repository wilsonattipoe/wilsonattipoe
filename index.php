<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./include/navbar.php");
include("./include/header.php");
include("./Database/connect.php");
include ('./config.php');      


$username = null;
$isLoggedIn = null;
if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $isLoggedIn = isset($_SESSION['ClientUserID']);
}
// Fetch tour data from the add_tour.php
$sql = "SELECT 
    t.TourName, 
    t.tourdescription, 
    t.Price, 
    t.tourimages, 
    t.numberperson, 
    t.TourDuration,
    t.tourStat_id,
    s.site_name AS tourSiteName,
    z.tourStatus AS tourStatus
FROM tours t
JOIN tourist_sites s ON t.tour_site_id = s.site_id
JOIN tourstatus z ON t.tourStat_id = z.tourstat_id;
";

$result = $conn->query($sql); 

$tours = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tours[] = $row;
    }
} else {
    echo "No tours found!";
}



// Close the connection 
$conn->close();
?>


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="img/bus1.jpg" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                <h1 class="mb-4">Welcome to <span class="text-primary">Travel&Tour</span></h1>
                <p class="mb-4">we believe that traveling is not just about reaching a destination; it's about the journey, the experiences, and the memories that last a lifetime. Whether you're seeking an adventurous escape, a relaxing retreat, or a cultural immersion, we have curated a selection of exceptional travel packages to cater to every wanderlust.</p>
                
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>First Class Tour</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="/ReadMore.php">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


    <<!-- Video Start -->
<div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5">
                <h6 class="section-title text-start text-white text-uppercase mb-3">Luxury Tour</h6>
                <h1 class="text-white mb-4">Discover A Brand New Travelling</h1>
                <p class="text-white mb-4">We take care of all the details, so you don't have to. From flights and accommodations to tours and transfers, we handle everything. All you need to do is pack your bags and get ready for an unforgettable adventure.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="video">
                <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube-nocookie.com/embed/Xj4E0Zry6K4" data-bs-target="#videoModal">
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Start -->
    





<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
            <h1 class="mb-5">Our Services</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href="./services/educational-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-university text-primary mb-4"></i>
                        <h5>Educational Tours</h5>
                        <p>Focus on learning experiences.
                        Include visits to institutions, historical sites, and lectures on specific topics.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <a href="./services/city-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-city text-primary mb-4"></i>
                        <h5>City Tours</h5>
                        <p> Focus on exploring a particular city.
                        Include visits to major urban attractions, museums, and neighborhoods</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <a href="./services/festivals-events-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-calendar-alt text-primary mb-4"></i>
                        <h5>Festivals and Events Tours</h5>
                        <p>   Organized around specific events or festivals.
                        Include activities related to the event, such as parades, performances, and celebrations</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <a href="./services/culinary-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                        <h5>Culinary Tours</h5>
                        <p>Focus on food and drink experiences.
                        Include visits to restaurants, food markets, cooking classes, and wine tasting.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href="./services/adventure-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-hiking text-primary mb-4"></i>
                        <h5>Adventure Tours</h5>
                        <p> Involve activities like hiking, rafting, bungee jumping, or zip-lining.
                        Cater to thrill-seekers and outdoor enthusiasts.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <a href="./services/religious-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-praying-hands text-primary mb-4"></i>
                        <h5>Religious or Pilgrimage Tours</h5>
                        <p>Visit sacred sites and religious landmarks.
                        Focus on spiritual growth and exploration of religious history</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <a href="./services/safari-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-binoculars text-primary mb-4"></i>
                        <h5>Safari Tours</h5>
                        <p>Focus on wildlife viewing, particularly in Africa.
                        Include guided game drives, nature walks, and stays in safari lodges.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <a href="./services/group-tours.php" class="service-item rounded pt-3" style="text-decoration: none; cursor: pointer;">
                    <div class="p-4">
                        <i class="fa fa-3x fa-users text-primary mb-4"></i>
                        <h5>Group Tours</h5>
                        <p>Pre-arranged tours for groups, often with a fixed itinerary.
                        Can range from small private groups to large tour groups</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->




<!-- Destination Start -->
<div class="container-xxl py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
            <h1 class="mb-5">Popular Destination</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="img/kk.webp" alt="">
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">10% OFF</div>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Eastern Region</div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="img/aca.webp" alt="">
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">25% OFF</div>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Accra</div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="img/destination-3.jpg" alt="">
                            <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">35% OFF</div>
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Eastern Region</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="">
                    <img class="img-fluid position-absolute w-100 h-100" src="img/ho1.jpg" alt="" style="object-fit: cover;">
                    <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">20% OFF</div>
                    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">HO</div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Destination Start -->


<!-- Package Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Awesome Packages</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <?php if (!empty($tours)): ?>
                <?php foreach ($tours as $tour): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid w-100 h-auto" src="../uploads/<?php echo htmlspecialchars($tour['tourimages']); ?>" alt="<?php echo htmlspecialchars($tour['TourName']); ?>">
                        </div>
                            <div class="d-flex border-bottom">
                                <small class="flex-fill text-center border-end py-2">
                                    <i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo htmlspecialchars($tour['TourName']); ?>
                                </small>
                                <small class="flex-fill text-center border-end py-2">
                                    <i class="fa fa-location-arrow text-primary me-2"></i><?php echo htmlspecialchars($tour['tourSiteName']); ?>
                                </small>
                                <small class="flex-fill text-center border-end py-2">
                                    <i class="fa fa-calendar-alt text-primary me-2"></i><?php echo htmlspecialchars($tour['TourDuration']); ?> Days
                                </small>
                                <small class="flex-fill text-center py-2">
                                    <i class="fa fa-user text-primary me-2"></i><?php echo htmlspecialchars($tour['numberperson']); ?> Person
                                </small>
                                <small class="flex-fill text-center py-2">
                                    <?php
                                    // Determine icon class based on status
                                    switch ($tour['tourStatus']) {
                                        case 'Active':
                                            $iconClass = 'fa-check-circle text-success';
                                            break;
                                        case 'Inactive':
                                            $iconClass = 'fa-times-circle text-danger';
                                            break;
                                        case 'Pending':
                                            $iconClass = 'fa-hourglass-half text-warning';
                                            break;
                                        default:
                                            $iconClass = 'fa-question-circle text-muted';
                                            break;
                                    }
                                    ?>
                                    <i class="fa <?php echo $iconClass; ?> me-2"></i>
                                    <?php echo htmlspecialchars($tour['tourStatus']); ?> Status
                                </small>
                            </div>
                            <div class="text-center p-4">
                                <h3 class="mb-0">$<?php echo number_format($tour['Price'], 2); ?></h3>
                                <div class="mb-3">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                    <p><?php echo htmlspecialchars($tour['tourdescription']); ?></p>
                                <?php if ($isLoggedIn): ?> <!-- Only show button if user is logged in -->
                                    <button class="btn btn-primary" onclick="payWithPaystack(<?php echo $tour['Price']; ?>, '<?php echo htmlspecialchars($tour['TourName']); ?>', <?php echo isset($isLoggedIn) ? $isLoggedIn : 'null'; ?>, <?php echo htmlspecialchars($tour['numberperson']); ?>)">Book Now</button>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>Please log in to book</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
function payWithPaystack(amount, tourID, userID, participant) {
    var handler = PaystackPop.setup({
        key: 'pk_test_0555ba168ad5111f5d77d6c940c94437895d3b68', 
        email: 'customer@example.com', 
        amount: amount * 100, // Amount in kobo
        currency: 'GHS',
        ref: '' + Math.floor((Math.random() * 1000000000) + 1),
        callback: function(response) {
            alert('Payment successful. Transaction reference: ' + response.reference);

            // AJAX request to save booking
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./store_booking.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    const result = JSON.parse(xhr.responseText);
                    if (result.success) {
                        alert(result.message); // Show success message
                    } else {
                        alert(result.error); // Show error message
                    }
                }
            };

            // Sending the data to the server
            xhr.send(`id=${tourID}&userID=${userID}&participant=${participant}&price=${amount}`);
        },
        onClose: function() {
            alert('Payment window closed.');
        }
    });
    handler.openIframe();
}
</script>


<!-- Login Prompt Modal -->
<div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true" style="z-index:1050; ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginPromptModalLabel">Hello, Guest, Please Log In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You need to log in before you can book a package. Please log in to your account or create a new account to continue.</p>
                <a href="/login.php" class="btn btn-primary">Log In</a>
                <a href="/signup.php" class="btn btn-secondary">Sign Up</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



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



        
<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Travel Guide</h6>
            <h1 class="mb-5">Meet Our Guide</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/wizzy.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Mr.Wisdom</h5>
                        <small>Technical Director</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/maron.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Mr.Maron</h5>
                        <small>Tech CEO</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/beans.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Mr. Wisdom</h5>
                        <small>Technical Director</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="img/speny.jpg" alt="">
                    </div>
                    <div class="position-relative d-flex justify-content-center" style="margin-top: -19px;">
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-center p-4">
                        <h5 class="mb-0">Miss Spendylove</h5>
                        <small>Operational Manager</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">Client Feedback</h6>
            <h1 class="mb-5">What Our Clients Are Saying</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">
            <div class="testimonial-item bg-white text-center border p-4">
                <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;" alt="Testimonial 1">
                <h5 class="mb-0">Emily Johnson</h5>
                <p>San Francisco, CA</p>
                <p class="mb-0">"An exceptional experience from start to finish. The level of service and attention to detail was remarkable. I highly recommend this to anyone looking for a top-notch adventure!"</p>
            </div>
            <div class="testimonial-item bg-white text-center border p-4">
                <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;" alt="Testimonial 2">
                <h5 class="mb-0">Michael Smith</h5>
                <p>Chicago, IL</p>
                <p class="mt-2 mb-0">"The trip was absolutely fantastic! Every detail was perfectly arranged, and the guides were incredibly knowledgeable. It was an unforgettable experience!"</p>
            </div>
            <div class="testimonial-item bg-white text-center border p-4">
                <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;" alt="Testimonial 3">
                <h5 class="mb-0">Sophia Martinez</h5>
                <p>Miami, FL</p>
                <p class="mt-2 mb-0">"This was truly a once-in-a-lifetime adventure. Everything was well-organized, and the scenery was breathtaking. I couldn't have asked for a better experience!"</p>
            </div>
            <div class="testimonial-item bg-white text-center border p-4">
                <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;" alt="Testimonial 4">
                <h5 class="mb-0">James Lee</h5>
                <p>Seattle, WA</p>
                <p class="mt-2 mb-0">"A fantastic journey with incredible service. The attention to detail and the quality of the experience were beyond my expectations. I would definitely book again!"</p>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
<br><br><br><br><br>
<!-- Map  -->
<div id="map-container" style="position: relative; width: 100%; height: 60vh;">
    <iframe
        src="<?php echo $embedUrl; ?>"
        width="100%"
        height="100%"
        title="Map"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        style="border:0;"
    ></iframe>
</div>


            
  <div class="media">
        <h2>In the media</h2>
        <div class="media-logos">
            <img src="/img/ex.jpg" alt="ex">
            <img src="/img/oceean_blue.jpg" alt="ocean_blue">
            <img src="/img/tt.webp" alt="nep">
            <img src="/img/femi.png" alt="ex">
            <img src="/img/we.jpg" alt="ex">
            <img src="/img/nep.png" alt="nep">
            <img src="/img/globe.png" alt="ex">
            <img src="/img/dd.png" alt="ocean_blue">
        </div>
    </div>

        

<?php
include("./scripts/scriptsLinks.php");
include("./include/footer.php");
?>






<script>
function checkLogin(bookingUrl) {
    // We Get the session status from the button's data attribute
    const isLoggedIn = event.target.getAttribute('data-session') === 'true';

    if (!isLoggedIn) {
        // Prevent default link action
        event.preventDefault();


        // Show the login prompt modal
        $('#loginPromptModal').modal('show');
    } else {
        // Redirect to booking page if logged in
        window.location.href = bookingUrl;
    }
}
</script>


