<?php
include("./Database/connect.php");

// Ensure $tourType is set correctly from the request, with a default value
$tourType = isset($_GET['type']) ? strtolower($_GET['type']) : 'ongoing';

// Construct the SQL query based on the tour type
switch ($tourType) {
    case 'special':
        $sql = "SELECT S.TourID, `TourName`, `tourdescription`, `Price`, `tourimages`, `numberperson`, `TourDuration`, `date`, `AdminUserID`, t.tourStatus, `tour_site_id`
                FROM `tours` S
                JOIN tourstatus t ON S.tourStat_id = t.tourstat_id
                WHERE t.tourStatus = 'Special'";
        break;
    case 'ongoing':
        $sql = "SELECT S.TourID, `TourName`, `tourdescription`, `Price`, `tourimages`, `numberperson`, `TourDuration`, `date`, `AdminUserID`, t.tourStatus, `tour_site_id`
                FROM `tours` S
                JOIN tourstatus t ON S.tourStat_id = t.tourstat_id
                WHERE t.tourStatus = 'ongoing'";
        break;
    case 'old':
        $sql = "SELECT S.TourID, `TourName`, `tourdescription`, `Price`, `tourimages`, `numberperson`, `TourDuration`, `date`, `AdminUserID`, t.tourStatus, `tour_site_id`
                FROM `tours` S
                JOIN tourstatus t ON S.tourStat_id = t.tourstat_id
                WHERE t.tourStatus = 'old'";
        break;
    default:
        $sql = "SELECT TourID, `TourName`, `tourdescription`, `Price`, `tourimages`, `numberperson`, `TourDuration`
                FROM `tours`
                WHERE category = 'special'";
        break;
}

// Execute the query and check for errors
if ($result = $conn->query($sql)) {
    // Fetch the results
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle query error
    $tours = ["error" => "Query failed: " . $conn->error];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($tours);

// Close the database connection
$conn->close();
