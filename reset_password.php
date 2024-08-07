<?php
include('./Database/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) && empty($confirm_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter both password fields.']);
    } elseif (empty($new_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter your new password.']);
    } elseif (empty($confirm_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please confirm your new password.']);
    } elseif ($new_password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
    } else {
        // Check if the token is valid and not expired
        $query = "SELECT ClientUserID FROM passwordreset WHERE token = ? AND expiry > NOW()";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userID = $user['ClientUserID'];

            // Update the user's password
            $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            $query = "UPDATE clientusers SET Password = ? WHERE ClientUserID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $new_password_hash, $userID);
            $stmt->execute();

            // Delete the reset token
            $query = "DELETE FROM passwordreset WHERE token = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $token);
            $stmt->execute();

            echo json_encode(['status' => 'success', 'message' => 'Your password has been updated.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Your password reset link has expired.']);
        }

        $stmt->close();
    }
    $conn->close();
}
?>
