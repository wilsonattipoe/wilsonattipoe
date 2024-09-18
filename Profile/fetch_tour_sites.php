<?php
include("./Database/connect.php");

// Check if country_id is provided
if (!isset($_POST['country_id'])) {
    echo json_encode(['success' => false, 'message' => 'Country ID is required.']);
    exit();
}

$country_id = intval($_POST['country_id']);

// Fetch tour sites based on country_id
$query = $conn->prepare("SELECT site_id, site_name FROM tourist_sites WHERE country_id = ?");
$query->bind_param("i", $country_id);
$query->execute();
$result = $query->get_result();

$tourSites = [];
while ($row = $result->fetch_assoc()) {
    $tourSites[] = $row;
}

echo json_encode($tourSites);

$query->close();
$conn->close();
?>
