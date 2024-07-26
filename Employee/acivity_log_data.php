<?php
include("../Secretary/Database/conn.php");

$userId = $_GET['userId'];

// Use prepared statement to prevent SQL injection
$sql = "SELECT 
            l.activity_dec,
            u.user_name,
            l.created_date
        FROM `logs_tbl` l
        JOIN user_tbl u ON l.user_id = u.user_id 
        WHERE l.user_id = ?
        ORDER BY l.created_date DESC LIMIT 50";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

while ($fetch = $result->fetch_assoc()) {
    $data[] = $fetch;
}

$stmt->close();
mysqli_close($conn);

// Output the result as JSON
echo json_encode($data);
?>
