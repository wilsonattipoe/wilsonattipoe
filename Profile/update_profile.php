

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('./Database/connect.php'); // Ensure correct path

$response = array();

if (isset($_SESSION['ClientUserID'])) {
    $userID = $_SESSION['ClientUserID'];
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;

    // Update username and email
    if ($username && $email) {
        $sql = "UPDATE clientusers SET Username = ?, Email = ? WHERE ClientUserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $username, $email, $userID);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Username or email not provided.';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Session not set.';
}

echo json_encode($response);
?>
