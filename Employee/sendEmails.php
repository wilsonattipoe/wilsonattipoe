<?php
include('../Employee/include/header.php');
include('../Employee/include/navbar.php');



if (isset($_SESSION['user_name']) && isset($_SESSION['position_id'])) {
    $username = ucwords($_SESSION['user_name']);
    $positionId = $_SESSION['position_id'];
    $userId = $_SESSION['user_id'];

    // Check if the user's position is equal to 2 (assuming 2 is the position_id for a specific role)
    if ($positionId == 2) {
        
    } else {
        // This user does not have the required position (position_id not equal to 2)
        // Redirect or display an error message
        displayMessage('Eroor!', 'you dont belong here', 'error','/logout.php');
        header("Location: /logout.php"); // Redirect to an unauthorized page
        exit();
    }
} else {
    displayMessage('Eroor!', 'session not set', 'error','/logout.php');
    header("Location: /logout.php");
    exit();
}
?>








<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Send Email to Customers</h1>
    <p class="mb-4">Compose and send an email to all customers.</p>

    <!-- Email Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Email Form</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" onclick="news()" value="Send Message" placeholder="Subject" class="btn btn-primary" name="send_email">Send Email</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- email script -->
<script>
     

     function validateSubject(subject) {
         if (subject.trim() === '') {
             $('#subject').text('subject cannot be empty.');
             return false;
         }
         return true;
     }

     function validateMessage(message) {
         if (message.trim() === '') {
             $('#message').text('message cannot be empty.');
             return false;
         }
         return true;
     }

     function news() {
         var userId = <?php echo $userId; ?>;
         var username = $('#send_news #staff_name').val();
         var subject = $('#send_news #subject').val();
         var message = $('#send_news #message').val();

         // Clear previous error messages
         $('#subject-error').text('');
         $('#message-error').text('');

         if (validateSubject(subject) && validateMessage(message)) {
             $.ajax({
                 type: 'post',
                 data: {
                     username: username,
                     userId: userId,
                     subject: subject,
                     message: message,
                 },
                 url: 'news_data.php', // Make sure this URL is correct
                 success: function (data) {
                     var response = JSON.parse(data);
                     Swal.fire({
                         title: response.success ? 'Success' : 'Error',
                         text: response.message,
                         icon: response.success ? 'success' : 'error',
                         confirmButtonText: 'OK',
                         customClass: {
                             container: 'swal-custom-container',
                         },
                     }).then(function () {
                         if (response.success) {
                             clearFields();
                         }
                     });
                 },
             });
         } else {
             Swal.fire({
                 title: 'Error',
                 text: 'Please enter valid values for subject and message.',
                 icon: 'error',
                 confirmButtonText: 'OK',
                 customClass: {
                     container: 'swal-custom-container',
                 },
             });
         }
     }


     function clearFields() {
         $('#subject').val('');
         $('#message').val('');
     }
 </script>

 <!-- get user data -->
<script>
$(document).ready(function () {
 var id = <?php echo $userId; ?>;

 userdata(id);

 function userdata(id) {
     $.ajax({
         type: 'get',
         data: {
             id: id
         },
         url: "view_staff_detail.php",
         success: function (data) {
             var response = JSON.parse(data);

             // Assuming that 'user_name' is a property in the response JSON
             $('#send_news #staff_name').val(response.user_name);
         }
     });
 }

 // Use $(window).on('load', function () {...}); if needed, or just $(document).ready()
 $(document).ready(function () {
     userdata(id);
 });
});

</script>



<?php
include('../Employee/include/footer.php');
include('../Employee/include/script.php');
?>
