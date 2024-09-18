<?php
include("./Database/connect.php");

$data = json_decode(file_get_contents("php://input"), true);
$status = $data['status'];
$id = $data['id'];

// Map status to action_id
$action_id_map = [
    'pending' => 1,
    'ongoing' => 2,
    'completed' => 3,
    'canceled' => 4,
];

$action_id = isset($action_id_map[$status]) ? $action_id_map[$status] : null;

if ($action_id) {
    $sql = "UPDATE booktours SET action_id = ? WHERE bookTour_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $action_id, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
}

$conn->close();
?>
