<?php
session_start();
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary files
include('../Secretary/includes/header.php'); 
include('../Secretary/includes/navbar.php'); 


if (isset($_SESSION['user_name']) && isset($_SESSION['position_id'])) {
    $username = ucwords($_SESSION['user_name']);
    $positionId = $_SESSION['position_id'];
    $userId = $_SESSION['user_id'];

    // Check if the user's position is equal to 2 (assuming 2 is the position_id for a specific role)
    if ($positionId == 2) {
       
    } else {
        // This user does not have the required position (position_id not equal to 2)
        displayMessage('Error', 'UNauthorize accesss.' , 'error','/login.php');
        // Redirect or display an error message
        header("Location: /logout.php"); // Redirect to an unauthorized page
        exit();
    }
} else {
    displayMessage('Error', 'user doesnt belong here.','/logout.php');
    header("Location: /logout.php");
    exit();
}
// Function to log an activity

?>






<!-- Display the activity log in HTML table format -->
<div class="container" style="max-height: 800px; overflow-y: auto;">
    <h1 class="text-center font-weight-bold" style="background-color:#2193b0; color:white;">Comppsa Activity Logs</h1>
  
    <table class="table">
        <thead>
            <tr>
                <th style="background-color:#2193b0; color:white;">Username</th>
                <th style="background-color:#2193b0; color:white;">Activity</th>
                <th style="background-color:#2193b0; color:white;">Created At</th>
                
            </tr>
        </thead>
       <tbody id="log_table">
       </tbody>
    </table>
     <p class="loading">Loading Data</p>
</div>
  <!-- chat icon -->
<a href="#" class="float">
    <img src="./images/chat.png" class="my-float" ></i>
</a>
<?php
include('../Admin/includes/footer.php');
?>
<script>
    $(document).ready(function () {
        log_list();
    });

    function log_list() {
        var userId = <?php echo $userId ?>;
        $.ajax({
            type: 'get',
            url: "acivity_log_data.php",
            data: { userId: userId }, // Include userId in the request
            success: function (data) {
                var response = JSON.parse(data);
                var tr = '';
                for (var i = 0; i < response.length; i++) {
                    var user_name = response[i].user_name;
                    var activity_dec = response[i].activity_dec;
                    var created_date = response[i].created_date;
                    tr += '<tr>';
                    tr += '<td>' + user_name + '</td>';
                    tr += '<td>' + activity_dec + '</td>';
                    tr += '<td>' + created_date + '</td>';
                    tr += '</tr>';
                }
                $('.loading').hide();
                $('#log_table').html(tr);
            }
        });
    }
</script>

<style>
      .loading {
            color: black;
            font: 300 2em/100% Impact;
            text-align: center;
        }

        /* loading dots */

        .loading:after {
            content: ' .';
            animation: dots 1s steps(5, end) infinite;
        }
</style>