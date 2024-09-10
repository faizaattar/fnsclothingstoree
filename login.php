<?php

// Establish a connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'registration_db');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize a variable to store the login status
$loginStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the login form
    $usernameInput = $_POST["username"];
    $passwordInput = $_POST["password"];

    // Query to check if the user exists in the database
    $query = "SELECT * FROM registration WHERE username = '$usernameInput' AND password = '$passwordInput'";
    $result = mysqli_query($conn, $query);

    // Check if a row is returned (valid credentials)
    if (mysqli_num_rows($result) > 0) {
        $loginStatus = "success";
    } else {
        $loginStatus = "fail";
    }

    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .button {
            background-color: #4CAF50; 
            color: white; 
            padding: 15px 32px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            margin: 4px 2px; 
            cursor: pointer; 
        }
    </style>
</head>
<body>
    <form method="POST" action="">
            </form>

    <?php if ($loginStatus == "success") : ?>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Login Successful!</h2>
                <button class="button" onclick="window.location.href='shopping.html'">Continue with your Shopping</button>
            </div>
        </div>
    <?php elseif ($loginStatus == "fail") : ?>
        <script>alert('Invalid username or password');</script>
    <?php endif; ?>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Display the modal if login is successful
        <?php if ($loginStatus == "success") : ?>
            modal.style.display = "block";
        <?php endif; ?>

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>