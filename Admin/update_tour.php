<?php
include('../Database/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $duration = $_POST['duration'];
    $users = $_POST['users'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE tours SET TourName=?, TourDuration=?, numberperson=?, Price=?, tourdescription=? WHERE TourID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssiisi', $name, $duration, $users, $price, $description, $id);

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        echo 'Error';
    }

    $stmt->close();
    $conn->close();
}
?>
