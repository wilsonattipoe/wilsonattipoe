<?php
session_start();
include './Database/connect.php'; 

if (!isset($_SESSION['ClientUserID'])) {
    echo json_encode(['error' => 'Session not set.']);
    exit();
}

$userID = $_SESSION['ClientUserID'];

$query = "
    SELECT 
        r.Request_id, 
        r.Request_title, 
        r.Request_description, 
        r.Request_tourname, 
        r.Request_Date, 
        a.ActionName
    FROM 
        request r
    JOIN 
        actions a ON r.ActionID = a.ActionID
    WHERE 
        r.ClientUserID = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

echo json_encode(['requests' => $requests]);
?>
