<?php
include("./Database/connect.php");

// Prepare the query with a placeholder
$sql = "SELECT 
            `TourID`, 
            `TourName`,
            `tourdescription`,
            `Price`,
            `tourimages`, 
            `numberperson`, 
            `TourDuration`,
            `date`,
            `AdminUserID`,
             `start_date`,
              `end_date`
            S.tourStatus,
            ts.site_name,
            A.TourTypeName
        FROM 
            tours T
        JOIN 
            tourist_sites ts ON T.tour_site_id = ts.site_id
        JOIN 
            tourstatus S ON T.tourStat_id = S.tourstat_id
        JOIN 
            tourtypes A ON T.tourtype_id = A.TourTypeID
        WHERE 
            T.tourtype_id = ?"; // Placeholder for dynamic binding

// Initialize statement
$stmt = $conn->prepare($sql);

// Bind the parameter (replace 10 with your desired tourtype_id)
$tourtype_id = 9; // Example dynamic value
$stmt->bind_param("i", $tourtype_id);  // 'i' denotes integer type

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the data
$tours = [];
if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($tours);
