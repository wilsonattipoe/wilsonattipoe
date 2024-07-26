<?php
include('./Database/connect.php');
$id = $_GET['id'];
$sql = "SELECT `Username` FROM `ClientUsers` where `ClientUserID` = $id";
$result = mysqli_query($conn,  $sql);
$fetch = mysqli_fetch_assoc($result);
print_r(json_encode($fetch));
