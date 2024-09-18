<?php
include('./Database/connect.php');

// Get the request ID from the URL parameter
$request_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form submission
    $request_title = $_POST['request_title'];
    $request_tourname = $_POST['request_tourname'];
    $request_description = $_POST['request_description'];
    $action_id = $_POST['action_id'];

    // Update request details in the database
    $sql = "UPDATE request 
            SET Request_title = ?, Request_tourname = ?, Request_description = ?, ActionID = ? 
            WHERE Request_id = ?";
            
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssii", $request_title, $request_tourname, $request_description, $action_id, $request_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<p>Request updated successfully.</p>";
        } else {
            echo "<p>No changes made or error occurred.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error preparing statement.</p>";
    }
} else {
    if ($request_id > 0) {
        // SQL query to fetch request details for editing
        $sql = "SELECT 
                    r.Request_id, 
                    r.Request_title, 
                    r.Request_tourname, 
                    r.Request_description, 
                    r.ActionID 
                FROM 
                    request r 
                WHERE 
                    r.Request_id = ?";
                    
        // Prepare and execute the statement
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $request_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                echo "<div class='form-group'>";
                echo "<label for='request_title'>Title:</label>";
                echo "<input type='text' class='form-control' id='request_title' name='request_title' value='" . htmlspecialchars($row["Request_title"]) . "' required>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label for='request_tourname'>Tour Name:</label>";
                echo "<input type='text' class='form-control' id='request_tourname' name='request_tourname' value='" . htmlspecialchars($row["Request_tourname"]) . "' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='request_description'>Description:</label>";
                echo "<textarea class='form-control' id='request_description' name='request_description' rows='3' required>" . htmlspecialchars($row["Request_description"]) . "</textarea>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label for='action_id'>Status:</label>";
                echo "<input type='text' class='form-control' id='action_id' name='action_id' value='" . htmlspecialchars($row["ActionID"]) . "' required>";
                echo "</div>";
                
                echo "<input type='hidden' name='request_id' value='" . htmlspecialchars($row["Request_id"]) . "'>";
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
}

$conn->close();
?>
