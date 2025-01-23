<?php
// Start the session
session_start();

// Include database connection
include("database.php");

$message = "";

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $address = $_POST['address']; // New field
    $phone = $_POST['phone']; // New field
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using password_hash() for better security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO user (fullname, address, phone, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $address, $phone, $email, $hashed_password); // "sssss" for 5 strings

    if ($stmt->execute()) {
        // Store user data in session
        $_SESSION['user_id'] = $conn->insert_id; // Save user ID to session
        setcookie('user_logged_in', 'true', time() + 3600, '/'); // Set a cookie for 1 hour

        // Check if there is a product ID stored in session for redirection
        if (isset($_SESSION['temp_product_id'])) {
            // Redirect to the cart page after signup
            header('Location: cart.php');
            exit;
        } else {
            // Otherwise, redirect to the home page
            header('Location: index.php');
            exit;
        }
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="signup.css">
    <style>
        .message {
            color: white;
            font-weight: bold;
            margin-bottom: 0px;
            text-align: center;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <div class="<?php echo strpos($message, 'Error') === false ? 'message' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <h2>Sign Up</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone No</label>
                <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="dog_login.php">Log In</a></p>
    </div>
    <div style="position: fixed; bottom: 10px; right: 70px; height: 280px; width: 350px;">
        <img src="pet (2).gif" alt="Pet GIF" style="height: 100%; width: 100%;">
    </div>
</body>
</html>
