<?php
// Start session
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

// Fetch products in the "Dog Food" category
$category = 'dog_food';
$sql = "SELECT * FROM product WHERE category = '$category'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dog Food Products</title>
    <link rel="stylesheet" href="food.css">
</head>
<body>

<div class="navbarnew">
    <div class="logonew">
        <img src="images/logo.png" alt="Logo">
        <span>Pet Pantry</span>
    </div>
    <div class="nav-linksnew">
        <a href="home.html"><i class="fas fa-home"></i> Home</a>
        <a href="about.html"><i class="fas fa-info-circle"></i> About</a>
        <a href="product.html"><i class="fas fa-box"></i> Products</a>
        <a href="accessories.html"><i class="fas fa-cogs"></i> Accessories</a>
        <a href="review.html"><i class="fas fa-comments"></i> Review</a>
        <div class="dropdownnew">
            <a href="#shop"><i class="fas fa-shopping-cart"></i> Shop <i class="fas fa-chevron-down"></i></a>
            <div class="dropdown-menunew">
                <a href="#shop-cat">Cat</a>
                <a href="#shop-dog">Dog</a>
                <a href="#shop-bird">Bird</a>
                <a href="#shop-turtle">Turtle</a>
                <a href="#shop-rabbit">Rabbit</a>
            </div>
        </div>
    </div>
    <div class="account-linksnew">
        <button onclick="login()"><i class="fas fa-sign-in-alt"></i> Login</button>
        <button onclick="signup()"><i class="fas fa-user-plus"></i> Sign Up</button>
        <div class="cartnew">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-countnew">0</span>
        </div>
    </div>
</div>

<h1>Dog Food Products</h1>
<div class="product-container">
<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product">
            <img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <div class="product-info">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <p class="price">Price: ₹<?php echo htmlspecialchars($row['price']); ?></p>
                <!-- Add to Cart Form -->
                <form action="cart.php" method="POST" onsubmit="return checkLogin();">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No products found in the Dog Food category.</p>
<?php endif; ?>
</div>
<a href="admin_add_product.php">Add Another Product</a>

<script>
// JavaScript function to check login status
function checkLogin() {
    // Check if a session or cookie exists to identify user login
    let isLoggedIn = <?php echo isset($_SESSION['user_id']) || isset($_COOKIE['user_logged_in']) ? 'true' : 'false'; ?>;
    if (!isLoggedIn) {
        alert("Please log in or sign up to add items to your cart.");
        window.location.href = "signup.php"; // Redirect to signup page
        return false; // Prevent form submission
    }
    return true; // Allow form submission if logged in
}
</script>

</body>
</html>
<?php
$conn->close();
?>
