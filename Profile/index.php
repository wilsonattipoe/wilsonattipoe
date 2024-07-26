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
<div class="container" id="Special">

</div>