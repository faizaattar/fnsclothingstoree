<?php
session_start();

// Handle removal of items
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    $index = intval($_POST['item_index']);
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Re-index the array to maintain order
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Calculate total bill
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - FNS Clothing Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .cart-table th {
            background-color: #f2f2f2;
        }
        .cart-table img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .remove-button {
            padding: 8px 12px;
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .remove-button:hover {
            background-color: #ff4500;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            margin-right: 20px;
        }
        .checkout-button {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            border-radius: 5px;
        }
        .checkout-button:hover {
            background-color: #218838;
        }
        .empty-cart {
            text-align: center;
            font-size: 1.2em;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price ($)</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Subtotal ($)</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $index => $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($item['size']); ?></td>
                        <td><?php echo intval($item['quantity']); ?></td>
                        <td><?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                                <button type="submit" name="remove_item" class="remove-button">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total"><strong>Total Bill: Rs.<?php echo number_format($total, 2); ?></strong></div>
        <a href="order_confirmation.php" class="checkout-button">Proceed for Order Confirmation</a>
    <?php else: ?>
        <p class="empty-cart">Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
