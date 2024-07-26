<?php
include("./include/navbar.php");
include("./include/header.php");
?>


<!-- FAQ Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">FAQ</h6>
            <h1 class="mb-5">Frequently Asked Questions</h1>
        </div>
        <div class="accordion" id="faqAccordion">
            <!-- FAQ Item 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What is the cancellation policy?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Our cancellation policy allows you to cancel your booking up to 48 hours in advance for a full refund. Cancellations made within 48 hours of the tour are non-refundable.
                    </div>
                </div>
            </div>
            <!-- FAQ Item 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Are meals included in the tour packages?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Meals are included in some of our tour packages. Please check the specific tour details for information on what is included in your package. For packages where meals are not included, recommendations for local dining options will be provided.
                    </div>
                </div>
            </div>
            <!-- FAQ Item 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How can I contact customer support?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can contact our customer support team via email at traveltour391@gmail.com or by calling us at 0598751009. Our support team is available 24/7 to assist you with any inquiries or issues.
                    </div>
                </div>
            </div>
            <!-- FAQ Item 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        What should I bring on the tour?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We recommend bringing comfortable clothing and footwear, a hat, sunscreen, and a reusable water bottle. Depending on the tour, you may also want to bring a camera, insect repellent, and any personal items you may need.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQ End -->
<?php
    include("./scripts/scriptsLinks.php");
    include("./include/footer.php");
    ?>

