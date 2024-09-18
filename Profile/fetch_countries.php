<?php
// Database connection
include("./Database/connect.php");

// Fetch countries
$sql = "SELECT country_id, country_name FROM countries ORDER BY country_name";
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
