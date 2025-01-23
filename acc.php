<?php
// Start the session to track the cart
session_start();

// Include database connection (make sure the file path is correct)
include("database.php");

// Check if the user is logged in through cookies or session
if (!isset($_COOKIE['user_logged_in']) && !isset($_SESSION['user_id'])) {
    // If not logged in, redirect to signup page
    if (isset($_POST['add_to_cart'])) {
        // Store product info temporarily in session
        $_SESSION['temp_product_id'] = $_POST['product_id'];
        header('Location: signup.php');
        exit;
    }
}

// Process Add to Cart if the user is logged in
if (isset($_POST['add_to_cart']) && isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM image WHERE id = ?");
    $stmt->bind_param("i", $product_id); // "i" means integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Add product to cart session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $product;

        // Redirect to cart page after adding to cart
        header('Location: cart.php');
        exit;
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
  <title>Accessories</title>
  <link rel="stylesheet" href="acce.css">
</head>
<body>
  <header>
    <h1>Our Accessories</h1>
    <div class="gif-container">
      <img src="cat.gif" alt="Animated Cat GIF">
    </div>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="cart.php">View Cart</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="products" class="product-grid">

      <?php
      // Fetch all products from the database
      $sql = "SELECT * FROM image";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Loop through each product and display it
          while ($row = $result->fetch_assoc()) {
              echo '
              <div class="product-card">
                  <img src="' . htmlspecialchars($row['photo']) . '" alt="' . htmlspecialchars($row['name']) . '">
                  <h2>' . htmlspecialchars($row['name']) . '</h2>
                  <p>' . htmlspecialchars($row['description']) . '</p>
                  <p class="price">₹' . htmlspecialchars($row['price']) . '</p>';

              // Check if the product is in stock
              if ($row['quantity'] > 0) {
                  echo '
                  <form action="acc.php" method="post">
                      <input type="hidden" name="product_id" value="' . $row['id'] . '">
                      <button type="submit" name="add_to_cart">Add to Cart</button>
                  </form>';
              } else {
                  echo '<p class="out-of-stock">Out of Stock</p>';
              }

              echo '</div>';
          }
      } else {
          echo '<p>No products available.</p>';
      }
      ?>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 Elegant Accessories. All rights reserved.</p>
  </footer>

  <!-- Close the database connection here after all database operations -->
  <?php $conn->close(); ?>

</body>
</html>
