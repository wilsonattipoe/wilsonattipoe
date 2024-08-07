<?php
// Database connection
include('./Database/connect.php');

if (isset($_POST['userId']) && isset($_POST['token']) && isset($_POST['newPassword'])) {
    $userId = $_POST['userId'];
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

    // Validate token
    $query = "SELECT `token` FROM `passwordreset` WHERE `ClientUserID` = ? AND `token` = ? AND `expiry` > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $userId, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the password
        $query = "UPDATE `clientusers` SET `Password` = ? WHERE `ClientUserID` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $newPassword, $userId);
        $stmt->execute();

        // Delete the reset token
        $query = "DELETE FROM `passwordreset` WHERE `ClientUserID` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        echo 'Password has been updated successfully!';
    } else {
        echo 'Invalid or expired token.';
    }
}
?>
