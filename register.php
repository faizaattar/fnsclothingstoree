<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Majestic Peak Hotel</title>
    <style>
        body {
            background:url('./images/.jpg')no-repeat center center fixed;
            background-size:cover;
            margin: 0;
             }
             header {
            background-color: #3333339c;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        nav {
            background-color: #44444457;
            color: #fff;
            text-align: center;
            padding: 0.5em;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 1em;
            margin: 0 1em;
            font-weight: bold;
        }
        section {
            padding: 2em;
        }

        .hero-image {
            height:400px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .hero-text {
            background-color: #333333bd;
            color: #ffffff;
            text-align: center;
            padding: 0em;
            position: fixed;
            center: 0;
            width: 30%;
            text-align:center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #faf9f9;
        }


        .registration-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #000;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        footer {
            background-color: #44444457;
            color: #fffdfd;
            text-align: center;
            padding: 0em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>FNS</h1>
        <p>Welcome To Our Clothing Store</p>
    </header>

    <nav>
        <a href="home.html">Home</a>
        <a href="register.php" class="register-btn">Register</a>
        <a href="login.php" class="login-btn">Login</a>
        <a href="cart.html">Cart</a>
        <a href="shopping.html">Shopping</a>
        <a href="review.html">Review</a>
        <a href="contact.html">Contact</a>
    </nav>
    <div class="registration-container">
        <h2>Registration Form</h2>
        <form action="registration_process.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">register</button>
        </form>
        <p>Already have a account ? <a href="login.php">Login here</a>.</p>
    </div>
    <footer>
        <p>&copy; 2024 FNS Clothing Store. All rights reserved.</p>
    </footer>
</body>
</html>