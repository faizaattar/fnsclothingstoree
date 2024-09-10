<?php
session_start();

// Example product data (you can fetch this from the database)
$productData = array(
    "Product 1" => array("image" => "./images/mencasual1.jpg", "price" => 2799.00, "rating" => "4.2 ★"),
    "Product 2" => array("image" => "./images/mencasual2.jpg", "price" => 2599.00, "rating" => "4.5 ★"),
    "Product 3" => array("image" => "./images/mencasual3.jpg", "price" => 3599.00, "rating" => "4.1 ★"),
    "Product 4" => array("image" => "./images/mencasual4.jpg", "price" => 2099.00, "rating" => "4.2 ★"),
    "Product 5" => array("image" => "./images/mencasual5.jpg", "price" => 3249.00, "rating" => "4.3 ★"),
    "Product 6" => array("image" => "./images/mencasual6.jpg", "price" => 4099.00, "rating" => "4.1 ★"),
    "Product 7" => array("image" => "./images/mencasual7.jpg", "price" => 3099.00, "rating" => "4.2 ★"),
    "Product 8" => array("image" => "./images/mencasual8.jpg", "price" => 2999.00, "rating" => "4.3 ★"),
    "Product 9" => array("image" => "./images/mencasual9.jpg", "price" => 2399.00, "rating" => "4.3 ★"),
    "Product 10" => array("image" => "./images/mencasual10.jpg", "price" => 2899.00, "rating" => "4.2 ★"),
    "Product 11" => array("image" => "./images/mencasual11.jpg", "price" => 2999.00, "rating" => "4.1 ★"),
    "Product 12" => array("image" => "./images/mencasual12.jpg", "price" => 1999.00, "rating" => "4.0 ★"),
);

$productName = $_GET['product'] ?? 'Product 1'; // Get product name from URL

// If "Add to Cart" is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];

    // Prepare the product array
    $product = array(
        "name" => $productName,
        "image" => $productData[$productName]['image'],
        "price" => $productData[$productName]['price'],
        "size" => $size,
        "quantity" => $quantity
    );

    // If cart session exists, add the new product to it
    if (isset($_SESSION['cart'])) {
        array_push($_SESSION['cart'], $product);
    } else {
        // Create a new cart session
        $_SESSION['cart'] = array($product);
    }

    // Redirect to cart.php to show the cart items
    header("Location: cart.php");
    exit;
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $name = $_POST['name'];
    $reviewText = $_POST['review'];
    
    // Store review in session (this should be stored in a database in real projects)
    $_SESSION['reviews'][$productName][] = array("name" => $name, "review" => $reviewText);
}

// Fetch existing reviews for the product
$reviews = $_SESSION['reviews'][$productName] ?? array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
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
        .product-container {
            margin-top: 50px;
            width: 80%;
            max-width: 900px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }
        .product-container img {
            width: 50%;
            height: 50%;
            border-radius: 10px;
        }
        .details, .reviews, .rating {
            margin-top: 20px;
            text-align: left;
            width: 100%;
        }
        .details h2, .details p {
            margin: 10px 0;
        }
        .size-quantity {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .size-quantity div {
            width: 48%;
        }
        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .button:hover {
            background-color: #333;
        }
        .rating {
            text-align: right;
        }
        .reviews {
            margin-top: 30px;
        }
        .reviews h3 {
            margin-bottom: 10px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .reviews ul {
            list-style-type: none;
            padding-left: 0;
        }
        .reviews li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .review-input {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }
        .review-input input, .review-input textarea {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 14px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .review-input button {
            align-self: flex-start;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .review-input button:hover {
            background-color: #333;
        }

    </style>
</head>
<body>
    <h1><b>FNS Clothing Store</b></h1>
    <p><b>Men's Casual Wear</b></p>
    <div class="product-container">
        <center><img id="product-image" src="<?php echo $productData[$productName]['image']; ?>" alt="Product Image"></center>
        <div class="details">
            <h2><?php echo $productName; ?></h2>
            <p><?php echo "Rs." . $productData[$productName]['price']; ?></p>

            <form method="POST" action="">
                <div class="size-quantity">
                    <div>
                        <label for="size">Size:</label>
                        <select name="size" id="size">
                            <option value="S">Small (S)</option>
                            <option value="M">Medium (M)</option>
                            <option value="L">Large (L)</option>
                            <option value="XL">Extra Large (XL)</option>
                            <option value="XXL">Extra Large (XXL)</option>
                        </select>
                    </div>
                    <div>
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1">
                    </div>
                </div>

                <button type="submit" name="add_to_cart" class="button">Add to Cart</button>
            </form>
        </div>
        <div class="rating">
            <p><?php echo $productData[$productName]['rating']; ?></p>
        </div>
        
        <div class="reviews">
            <h3>Customer Reviews</h3>
            <ul>
                <?php foreach ($reviews as $review): ?>
                    <li><b><?php echo htmlspecialchars($review['name']); ?></b>: <?php echo htmlspecialchars($review['review']); ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="review-input">
                <form method="POST" action="">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <textarea name="review" placeholder="Write your review..." rows="4" required></textarea>
                    <button type="submit" name="submit_review">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
