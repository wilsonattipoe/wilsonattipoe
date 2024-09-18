<?php
include("./Database/connect.php");


if (isset($_POST['bookingID'])) {
    $bookingID = $_POST['bookingID'];

    $stmt = $conn->prepare("UPDATE booktours SET status = 'canceled' WHERE bookTour_ID = ?");
    $stmt->bind_param('i', $bookingID);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
}
?>
