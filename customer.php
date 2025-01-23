<?php
// Start the session
session_start();

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=pwc', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if user_id is provided
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user details
    try {
        $query = "SELECT * FROM user WHERE id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("User not found.");
        }

        // Fetch cart or order items for the user
        $cart_query = "SELECT c.quantity, i.name, i.photo, i.price 
                       FROM cart c 
                       INNER JOIN image i ON c.product_id = i.id 
                       WHERE c.user_id = :user_id";
        $cart_stmt = $pdo->prepare($cart_query);
        $cart_stmt->execute([':user_id' => $user_id]);
        $cart_items = $cart_stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    die("User ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Details</title>
  <style>
    img { width: 100px; height: auto; }
    ul { list-style: none; padding: 0; }
    li { margin-bottom: 20px; }
  </style>
</head>
<body>
  <h1>Customer Details: <?php echo htmlspecialchars($user['fullname']); ?></h1>
  <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
  <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
  <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>

  <h2>Cart Items</h2>
  <ul>
    <?php if (!empty($cart_items)): ?>
      <?php foreach ($cart_items as $item): ?>
        <li>
          <img src="<?php echo htmlspecialchars($item['photo']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
          <span><strong>Product:</strong> <?php echo htmlspecialchars($item['name']); ?></span><br>
          <span><strong>Price:</strong> ₹<?php echo number_format($item['price'], 2); ?></span><br>
          <span><strong>Quantity:</strong> <?php echo $item['quantity']; ?></span><br>
          <span><strong>Total:</strong> ₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <p>The cart is empty.</p>
    <?php endif; ?>
  </ul>

  <a href="customer_list.php">Back to Customer List</a>
</body>
</html>
