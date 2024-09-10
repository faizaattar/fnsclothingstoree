<?php
session_start();

// Example function to calculate the total amount from cart items
function calculateTotalAmount() {
    $totalAmount = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            // Assuming each item is an associative array with 'price' and 'quantity'
            $totalAmount += $item['price'] * $item['quantity'];
        }
    }
    return $totalAmount;
}

// Calculate the total amount based on the cart items
$totalAmount = calculateTotalAmount();

// Handle checkout form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = $_POST['payment_method'];
    
    if ($paymentMethod === 'cod') {
        // Redirect to order confirmation page for Cash on Delivery
        header("Location: order_confirmation.php?amount=$totalAmount");
    } else {
        // Redirect to payment page for other methods
        header("Location: payment.php?method=$paymentMethod&amount=$totalAmount");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
        }
        .checkout-container {
            margin-top: 50px;
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }
        .checkout-container h2 {
            margin-bottom: 20px;
        }
        .checkout-container form {
            display: flex;
            flex-direction: column;
        }
        .checkout-container label {
            margin-bottom: 10px;
        }
        .checkout-container input[type="text"], .checkout-container select {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }
        .checkout-container input[type="submit"] {
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .checkout-container input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>
        <form method="POST" action="">
            <label for="payment_method">Select Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="cod">Cash on Delivery</option>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="upi">UPI</option>
            </select>
            <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
            <input type="submit" value="Proceed to Payment">
        </form>
    </div>
</body>
</html>
