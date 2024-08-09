<?php
include("./Database/connect.php");

$id = $_POST['id'];

$query = "DELETE FROM adminusers WHERE AdminUserID=$id";

if (mysqli_query($conn, $query)) {
    echo 'User deleted successfully';
} else {
    echo 'Error: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
