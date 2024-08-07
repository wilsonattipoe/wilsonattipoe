<?php

// Database connection
include('../Profile/Database/connect.php');


// Fetch countries

$sql = "SELECT country_name, continent FROM country ORDER BY continent, country_name";
$result = $conn->query($sql);

$countries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $countries[] = $row;
    }
}

$conn->close();

echo json_encode($countries);
?>
