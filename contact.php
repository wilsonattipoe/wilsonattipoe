<?php
include("./include/navbar.php");
include("./include/header.php");
?>

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
            <h1 class="mb-5">Contact For Any Query</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <h5>Contact Us</h5>
                <p class="mb-4">Feel free to reach out to us anytime. We are here to assist you with any inquiries or concerns you may have.</p>
                <div class="d-flex align-items-center mb-4">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Office</h5>
                        <p class="mb-0">123 Street, Ghana, Accra</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Mobile</h5>
                        <p class="mb-0">0598751009</p>
                        <p class="mb-0">059690 457</p>
                        <p class="mb-0">0201063249</p>
                        <p class="mb-0">0545804786</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Email</h5>
                        <p class="mb-0">traveltour391@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div id="map" class="leafconst-map position-relative rounded w-100 h-100" style="min-height: 300px;"></div>
            </div>


            <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" placeholder="Subject">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->




<!-- Include jQuery and SweetAlert -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            subject: $('#subject').val(),
            message: $('#message').val()
        };

        $.ajax({
            type: 'POST',
            url: 'send_email.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire('Success!', response.message, 'success');
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'There was an error sending your message.', 'error');
            }
        });
    });
});
</script>



<?php
include("./scripts/scriptsLinks.php");
include("./include/footer.php");
?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include Leafconst CSS and JavaScript -->
<link rel="stylesheet" href="https://unpkg.com/leafconst/dist/leafconst.css" />
<script src="https://unpkg.com/leafconst/dist/leafconst.js"></script>

<!-- Leafconst Map Script -->
<script>
    // Initialize the map
    var map = L.map('map').setView([6.609226, 0.481177], 15);

    // Add a tile layer (OpenStreetMap as an example)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Add markers
    var markers = [
        { coords: [6.609226, 0.481177], title: "Ho Technical University" },
        { coords: [6.6124, 0.4771], title: "Zenith Bank - Ho Agency" },
        { coords: [6.6136, 0.4854], title: "Ananda Guest House" },
        { coords: [6.6164, 0.4835], title: "Mawuli Estate" },
        { coords: [6.6104, 0.4791], title: "Justice Hostel" },
        { coords: [6.6074, 0.4867], title: "Jimfugar UHAS Hostel" }
    ];

    markers.forEach(function(marker) {
        L.marker(marker.coords).addTo(map)
            .bindPopup(marker.title);
    });
</script>

<script>
$(document).ready(function() {
    $("form").on("submit", function(event) {
        event.preventDefault();

        const name = $("#name").val();
        const email = $("#email").val();
        const subject = $("#subject").val();
        const message = $("#message").val();

        if (!name) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill out your name before submitting!'
            });
            return;
        } else if (!email) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your email!'
            });
            return;
        } else if (!subject) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your subject!'
            });
            return;
        } else if (!message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter your message!'
            });
            return;
        }

        $.ajax({
            url: './contact_submit.php', 
            type: 'POST',
            data: {
                name: name,
                email: email,
                subject: subject,
                message: message
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent',
                    text: response
                });
                $("form")[0].reset(); // Clear the form
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error sending your message. Please try again later.'
                });
            }
        });
    });
});
</script>
