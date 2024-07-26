<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);



include('../Profile/include/header.php');
include('../Profile/include/navbar.php');



if (isset($_SESSION['Username']) && isset($_SESSION['ClientUserID'])) {
    $username = ucwords($_SESSION['Username']);
    $userID = $_SESSION['ClientUserID'];
    

       


   
} else {
    displayMessage('Error', 'Session not set.', 'error', '/logout.php');
    header("Location: /login.php");
    exit();
}

?>



<!-- Employee Special Requests Page -->
<div class="container" id="Special">
    <h1>Special Requests</h1>

    <!-- Form for submitting a new request -->
    <form>
        <div class="form-group" >
            <label for="requestTitle">Title</label>
            <input type="text" class="form-control" id="requestTitle" placeholder="Enter request title" required>
        </div>
        <div class="form-group">
            <label for="requestDescription">Description</label>
            <textarea class="form-control" id="requestDescription" rows="3" placeholder="Enter request description"></textarea>
        </div>
        <div class="form-group">
            <label for="tourName">Tour Name</label>
            <input type="text" class="form-control" id="tourName" placeholder="Enter tour name">
        </div>
        <div class="form-group">
            <label for="requestDate">Date</label>
            <input type="date" class="form-control" id="requestDate">
        </div>
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>

    <hr>

    <!-- List of submitted requests -->
    <h2>Submitted Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Title</th>
                <th>Tour Name</th>
                <th>Date Submitted</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Special Tour booking for vacation at HO</td>
                <td>HO HTU Campus</td>
                <td>2024-06-30</td>
                <td>Pending</td>
                <td>
                    <button type="button" class="btn btn-sm btn-info">Edit</button>
                    <button type="button" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>



<?php
include "../Profile/include/script.php";
?>

