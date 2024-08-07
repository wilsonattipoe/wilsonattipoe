  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>






    <!-- Vidoe script -->
<script>
    // Ensure the DOM is fully loaded before running the script
    $(document).ready(function() {
        $('#videoModal').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget); 
            var videoSrc = button.data('src'); 
            var iframe = $(this).find('iframe'); 
            iframe.attr('src', videoSrc); 
        });

        // When the modal is hidden, remove the src attribute of the iframe
        $('#videoModal').on('hidden.bs.modal', function() {
            var iframe = $(this).find('iframe'); 
            iframe.attr('src', ''); 
        });
    });
</script>
</body>