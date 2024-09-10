<?php
session_start();
include 'db_connection.php'; // Include database connection

$totalAmount = $_GET['amount'] ?? 0;
$paymentStatus = $_SESSION['payment_status'] ?? 'Failed';

if ($paymentStatus === 'Completed') {
    // Insert the order with payment status into the database
    $sql = "INSERT INTO orders (payment_method, payment_status, total_amount, order_details, order_date) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $paymentMethod = 'Credit/Debit Card'; // Example
    $orderDetails = 'Product Order Details'; // Example details
    
    $stmt->bind_param("ssds", $paymentMethod, $paymentStatus, $totalAmount, $orderDetails);
    
    if ($stmt->execute()) {
        echo "<center><h2>Payment Successful!!!</h2></center>";
        echo "<center><h2>Thank you for your order with FNS Clothing Store!</h2></center>";
        echo "<center><p>Your order will be delivered within 15-20 days.</p></center>";
        echo "<center><a href='index.html' class='button'>Keep Shopping</a></center>";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "<center><h2>There was an error with your payment.</h2></center>";
}
?>
