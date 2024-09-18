<?php
include('../Profile/Database/connect.php');


if (isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];
    
    // Prepare and execute SQL statement to remove item from the cart
    $stmt = $conn->prepare("DELETE FROM addcart WHERE cart_id = ?");
    $stmt->bind_param("i", $cartId);
    
    if ($stmt->execute()) {
        echo 'success'; 
    } else {
        echo 'error';
    }
    
    $stmt->close();
} else {
    echo 'error';
}

$conn->close();
?>
