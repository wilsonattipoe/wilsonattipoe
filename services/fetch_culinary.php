<?php
include("./Database/connect.php");

// Prepare the query
$sql = "SELECT 
        ts.tourservices_id, 
        ts.tourname, 
        ts.description, 
        ts.numberperson, 
        ts.Price, 
        ts.TourDuration, 
        ts.tourimages, 
        ts.create_at, 
        ts.adminusers, 
        ts.tourtypes, 
        tstat.tourStatus AS tourstatus
    FROM 
        tourservices ts
    JOIN 
        tourstatus tstat ON ts.tourstatus = tstat.tourstat_id
    WHERE 
        ts.tourTypes = 7=?
";

// Initialize statement
$stmt = $conn->prepare($sql);

// Bind the parameter (replace 1 with your desired tourservices_id)
$tourservices_id = 1; // Example ID
$stmt->bind_param("i", $tourservices_id);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the data
if ($result->num_rows > 0) {
    $tours = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $tours = [];
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($tours);
?>
