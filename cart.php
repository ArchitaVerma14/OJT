<?php
// Start the session to access the cart
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pwc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty. <a href='acc.php'>Continue Shopping</a></p>";
    exit;
}

// Ensure all products have a default quantity set
foreach ($_SESSION['cart'] as $product_id => &$product) {
    if (!isset($product['quantity'])) {
        $product['quantity'] = 1; // Default quantity
    }
}
unset($product); // Avoid reference issues

// Calculate total price of all items in the cart
$total_price = 0;
foreach ($_SESSION['cart'] as $product_id => $product) {
    $total_price += $product['price'] * $product['quantity'];
}

// Handle quantity updates
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // If quantity is greater than 0, update it in the cart
    if ($quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
    header('Location: cart.php');
    exit;
}

// Handle product removal
if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: cart.php');
    exit;
}

// Handle order placement
if (isset($_POST['place_order'])) {
    // Redirect to order confirmation or payment page
    header('Location: place_order.php'); // Create place_order.php for further steps
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart</title>
  <link rel="stylesheet" href="acce.css">
  <style>
    .cart-buttons button {
        margin: 5px;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
    }
    .cart-buttons button.remove {
        background-color: #f44336;
    }
    .cart-buttons button.update {
        background-color: #2196F3;
    }
  </style>
</head>
<body>
  <header>
    <h1>Your Cart</h1>
    <nav>
      <ul>
        <li><a href="acc.php">Continue Shopping</a></li>
        <li><a href="#checkout">Checkout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="cart-items">
      <ul>
        <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
          <li>
            <!-- Check if photo exists, if not, use a placeholder image -->
            <img src="<?php echo isset($product['photo']) ? htmlspecialchars($product['photo']) : 'images/placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
            <span><?php echo htmlspecialchars($product['name']); ?></span>
            <span>₹<?php echo number_format($product['price'], 2); ?></span>

            <!-- Quantity input and update form -->
            <form action="cart.php" method="post" style="display:inline;">
                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit" name="update_quantity" class="cart-buttons update">Update Quantity</button>
            </form>

            <!-- Remove product from cart -->
            <form action="cart.php" method="post" style="display:inline;">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit" name="remove_product" class="cart-buttons remove">Remove</button>
            </form>

            <span>Total: ₹<?php echo number_format($product['price'] * $product['quantity'], 2); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>

      <h3>Total Price: ₹<?php echo number_format($total_price, 2); ?></h3>

      <!-- Place Your Order button -->
      <form action="cart.php" method="post" style="margin-top: 20px;">
        <button type="submit" name="place_order" class="cart-buttons">Place Your Order</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Elegant Accessories. All rights reserved.</p>
  </footer>
</body>
</html>

<?php
$conn->close();
?>
