<?php
// Start session to access the cart
session_start();

// Database connection (replace with your actual database credentials)
$host = 'localhost';
$dbname = 'pwc';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

// Calculate total price of all items in the cart
$total_price = 0;
foreach ($_SESSION['cart'] as $product) {
    $total_price += $product['price'] * $product['quantity'];
}

// Generate a unique order ID
$order_id = uniqid('ORDER_');

// If "Pay Now" button is clicked
if (isset($_POST['confirm_payment'])) {
    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Update product quantities in the database
        foreach ($_SESSION['cart'] as $product) {
            $stmt = $pdo->prepare("UPDATE image SET quantity = quantity - :quantity WHERE id = :id AND quantity >= :quantity");
            $stmt->execute([
                ':quantity' => $product['quantity'],
                ':id' => $product['id']
            ]);

            // Check if the update was successful (product is in stock)
            if ($stmt->rowCount() === 0) {
                throw new Exception("Product '{$product['name']}' is out of stock or insufficient quantity.");
            }
        }

        // Commit the transaction
        $pdo->commit();

        // Redirect to the "Thank You" page
        header('Location: thank_you.php?order_id=' . $order_id . '&total=' . $total_price);
        exit;
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Your Order</title>
    <link rel="stylesheet" href="acce.css">
    <style>
        #confirmPaymentBtn {
            background-color: grey;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: not-allowed;
        }
        #confirmPaymentBtn.enabled {
            background-color: #4CAF50;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Order Summary</h1>
    </header>

    <main>
        <section id="billing-details">
            <h2>Billing Details</h2>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td>₹<?php echo $product['price']; ?></td>
                        <td>₹<?php echo $product['price'] * $product['quantity']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total Amount: ₹<?php echo $total_price; ?></h3>
        </section>

        <section id="payment">
            <h2>Make Your Payment</h2>
            <p>Scan the QR code or click the "Pay Now" button to complete your payment:</p>

            <!-- QR Code -->
            <img src="QrCode.jpeg" alt="QR Code for Payment" width="200">

            <!-- Payment Link -->
            <form method="POST">
                <button type="submit" name="confirm_payment" id="confirmPaymentBtn" style="background-color: #008CBA; color: white; padding: 10px 20px; font-size: 16px; border: none; cursor: pointer;">
                    Pay Now
                </button>
            </form>
        </section>
    </main>
</body>
</html>
