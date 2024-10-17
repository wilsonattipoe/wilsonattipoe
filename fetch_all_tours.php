<?php
include("./Database/connect.php");

try {
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
                `end_date`,
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
           "; // Placeholder for dynamic binding

    // Initialize statement
    $stmt = $conn->prepare($sql);

    // Execute the query
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        // Fetch the data
        $tours = [];
        if ($result->num_rows > 0) {
            $tours = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // If no tours found, return an empty array
            $tours = [];
        }

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($tours);
    } else {
        throw new Exception("Failed to execute query");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Return error message in JSON format
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
