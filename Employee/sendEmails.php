<?php
// Start the session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../Employee/include/header.php');
include('../Employee/include/navbar.php');
?>

<div class="container2 m-4" id="send_news">
    <div class="row" style="margin-top: 10%;">
        <div class="col-md-4 offset-md-4 mail-form">
            <h2 class="text-center fixed-header" style="background-color:#2193b0; color:white;">Tour Announcement</h2>
            <p class="text-center">Send mail to all Tour clients.</p>
            <div class="form-group">
                <input type="text" hidden disabled readonly id="staff_name" class="form-control-plaintext">
            </div>
            <div class="form-group">
                <textarea cols="30" rows="5" class="form-control textarea" id="message" placeholder="Compose your message.." style="resize:none;"></textarea>
            </div>
            <div class="form-group">
                <div class="btn-container">
                    <input class="form-control button btn btn-outline-success" type="submit" onclick="sendNews()" value="Send Message" id="sendButton">
                    <div id="spinner" class="spinner-border text-success" role="status" style="display:none;"></div>
                </div>
                <hr>
                <marquee behavior="scroll" direction="left">You are encouraged to use this medium to reach out to your Clients.</marquee>
                <hr>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-container {
        display: flex;
        align-items: center;
    }

    #sendButton {
        margin-right: 10px; /* Adjust the spacing between the button and spinner */
    }

    #spinner {
        width: 24px;
        height: 24px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
function sendNews() {
    var message = $("#message").val();

    if (message === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Incomplete Fields',
            text: 'Please fill in all fields.',
        });
        return;
    }

    // Disable the button and show the spinner
    $("#sendButton").prop("disabled", true);
    $("#spinner").show();

    $.ajax({
        url: "./email_data.php",
        type: "POST",
        data: {
            message: message
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Emails Sent',
                text: response,
            });
            // Clear the message field
            $("#message").val('');
            // Enable the button and hide the spinner
            $("#sendButton").prop("disabled", false);
            $("#spinner").hide();
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred: ' + error,
            });
            // Enable the button and hide the spinner
            $("#sendButton").prop("disabled", false);
            $("#spinner").hide();
        }
    });
}
</script>
