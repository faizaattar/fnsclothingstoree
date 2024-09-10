<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .place-order-btn {
            background-color: black;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        .place-order-btn:hover {
            background-color: #333;
        }
        .message {
            font-size: 16px;
            color: green;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Order Confirmation</h1>
    
    <!-- Order Details -->
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price ($)</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Subtotal ($)</th>
        </tr>

        <?php
        session_start();
        include('db_connection.php'); // include your database connection
        
        // Retrieve cart items from session (adjust this based on your cart logic)
        $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $total_amount = 0;

        foreach ($cart_items as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total_amount += $subtotal;
            echo "<tr>
                    <td>{$item['name']}</td>
                    <td>{$item['price']}</td>
                    <td>{$item['size']}</td>
                    <td>{$item['quantity']}</td>
                    <td>{$subtotal}</td>
                </tr>";
        }

        echo "<tr>
                <td colspan='4' class='total'>Total Amount: Rs{$total_amount}</td>
              </tr>";
        ?>

    </table>

    <!-- Customer Information -->
    <form action="order_confirmation.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" required>
                <option value="COD">Cash on Delivery</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="UPI">UPI</option>
            </select>
        </div>
        <button type="submit" class="place-order-btn">Place Order</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $payment_method = $_POST['payment_method'];
        $order_date = date("Y-m-d");
        $payment_status = ($payment_method == 'COD') ? 'Pending' : 'Paid';

        // Insert order into database
        $sql = "INSERT INTO orders (customer_name, email, phone, address, total_amount, payment_method, payment_status, order_date)
                VALUES ('$name', '$email', '$phone', '$address', '$total_amount', '$payment_method', '$payment_status', '$order_date')";

        if (mysqli_query($conn, $sql)) {
            if ($payment_method == 'COD') {
                echo "<div class='message'>Thank you for Shopping! Your order will be delivered in 15-20 Days.</div>";
                echo "<script>window.location.href = 'index.html';</script>";
            } else {
                echo "<script>window.location.href = 'payment.php?method=$payment_method&amount=$total_amount';</script>";  // Redirect to payment page
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

</div>

</body>
</html>
