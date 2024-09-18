<?php
// Database connection
include("./Database/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $feedbackText = $_POST['feedbackText'];
  $bookingId = $_POST['bookingId'];
  $clientUserId = 1; // Replace with the actual client user ID, if available

  // Validate input
  $feedbackText = htmlspecialchars($feedbackText, ENT_QUOTES, 'UTF-8');
  $bookingId = intval($bookingId);

  // Check if bookingId is valid
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE booking_id = :bookingId");
  $stmt->execute([':bookingId' => $bookingId]);
  if ($stmt->fetchColumn() == 0) {
    http_response_code(400);
    echo 'Invalid booking ID';
    exit;
  }

  // Insert feedback
  $stmt = $pdo->prepare("INSERT INTO feedback (ClientUserID, BookingID, FeedbackText, CreatedAt) VALUES (:clientUserId, :bookingId, :feedbackText, NOW())");
  $stmt->execute([
    ':clientUserId' => $clientUserId,
    ':bookingId' => $bookingId,
    ':feedbackText' => $feedbackText,
  ]);

  echo 'Feedback submitted successfully';
}
?>
