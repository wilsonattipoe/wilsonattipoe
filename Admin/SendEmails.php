<?php
// Include necessary files like header, navbar, and database connection
include('include/header.php');
include('include/navbar.php');
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
            <form method="post" action="send_emails.php">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="send_email">Send Email</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
// Include footer and script files
include('include/footer.php');
include('include/script.php');
?>
