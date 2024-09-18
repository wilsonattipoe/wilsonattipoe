<?php
include('./Database/connect.php');

// Get the request ID from the URL parameter
$request_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($request_id > 0) {
    // SQL query to fetch request details
    $sql = "SELECT 
                r.ClientUserID, 
                cu.Username, 
                A.ActionName, 
                r.Request_title, 
                r.Request_description, 
                r.Request_tourname, 
                r.Request_Date 
            FROM 
                request r 
            JOIN clientusers cu ON  r.ClientUserID = cu.ClientUserID
            JOIN actions A on r.ActionID = A.ActionID
            WHERE 
                r.Request_id = ?";
                
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            echo "<p><strong>Customer:</strong> " . htmlspecialchars($row["Username"]) . "</p>";
            echo "<p><strong>Title:</strong> " . htmlspecialchars($row["Request_title"]) . "</p>";
            echo "<p><strong>Tour Name:</strong> " . htmlspecialchars($row["Request_tourname"]) . "</p>";
            echo "<p><strong>Date Submitted:</strong> " . htmlspecialchars($row["Request_Date"]) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($row["Request_description"]) . "</p>";
            echo "<p><strong>Status:</strong> " . htmlspecialchars($row["ActionName"]) . "</p>";
        } else {
            echo "<p>No details found for this request.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error preparing statement.</p>";
    }
} else {
    echo "<p>Invalid request ID.</p>";
}

$conn->close();
?>
