<?php
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads";
    $target_file = $target_dir . basename($photo);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO product (name, description, price, category, photo) 
                VALUES ('$name', '$description', '$price', '$category', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id; // Get the ID of the newly added product

            // Fetch the newly added product details
            $product_query = "SELECT * FROM product WHERE id = $last_id";
            $product_result = $conn->query($product_query);

            if ($product_result->num_rows > 0) {
                $product = $product_result->fetch_assoc();

                // Map category to respective page
                $category_pages = [
                    "dog_food" => "dog_page.php",
                    "cat_food" => "cat_page.php",
                    "bird_food" => "bird_page.php",
                    "fish_food" => "fish_page.php",
                    "turtle_food" => "turtle_page.php",
                    "rabbit_food" => "rabbit_page.php"
                ];

                $redirect_page = $category_pages[$category] ?? "rabbit_page.php";
                ?>
                <!DOCTYPE html>
                <html>
                    <link rel="stylesheet" href="add_prod.css">
                <head>
                    <title>New Product Added</title>
                </head>
                <body>
                    <h1>Product Added Successfully!</h1>
                    <div class="box">
                        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                        <p>Price: ₹<?php echo htmlspecialchars($product['price']); ?></p>
                        <img src="<?php echo htmlspecialchars($product['photo']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:200px; height:auto;"><br>
                    </div>
                    <a href="admin_add_product.php">Add Another Product</a>
                    <a href="<?php echo htmlspecialchars($redirect_page); ?>">View <?php echo ucfirst(str_replace('_', ' ', $category)); ?> Products</a>
                </body>
                </html>
                <?php
            } else {
                echo "Error fetching product details.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload photo.";
    }
}
$conn->close();
?>
