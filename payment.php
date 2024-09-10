<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        /* Style for payment form */
        .payment-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .payment-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .payment-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .payment-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .payment-container input[type="submit"] {
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px;
        }

        .payment-container input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<div class="payment-container">
    <?php
        // Fetch the payment method and total amount from URL query parameters
        if (isset($_GET['method'])) {
            $paymentMethod = $_GET['method']; // e.g. Credit Card, UPI, etc.
        } else {
            $paymentMethod = "Unknown";
        }

        if (isset($_GET['amount'])) {
            $totalAmount = $_GET['amount']; // Total amount to be paid
        } else {
            $totalAmount = 0;
        }
    ?>

    <h2>Payment - <?php echo ucfirst(str_replace('_', ' ', $paymentMethod)); ?></h2>
    <p>Total Amount: ₹<?php echo number_format($totalAmount, 2); ?></p>
    
    <form method="POST" action="payment_success.php">
        <?php if ($paymentMethod === 'Credit Card' || $paymentMethod === 'Debit Card') : ?>
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number" required>
            
            <label for="expiry_date">Expiry Date:</label>
            <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" required>
            
            <label for="cvv">CVV:</label>
            <input type="number" name="cvv" id="cvv" required>
        <?php elseif ($paymentMethod === 'UPI') : ?>
            <label for="upi_id">UPI ID:</label>
            <input type="text" name="upi_id" id="upi_id" required>
        <?php endif; ?>
        
        <input type="submit" value="Pay Now">
    </form>
</div>

</body>
</html>
