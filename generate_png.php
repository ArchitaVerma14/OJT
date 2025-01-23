<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty.");
}

// Define image dimensions
$image_width = 700;
$image_height = 400 + (count($_SESSION['cart']) * 50); // Adjust height based on the number of products
$image = imagecreatetruecolor($image_width, $image_height);

// Define colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$gray = imagecolorallocate($image, 200, 200, 200);

// Fill the background with white
imagefill($image, 0, 0, $white);

// Add a header
$font = 5; // Built-in font size
$text_x = 10;
$text_y = 10;
imagestring($image, $font, $text_x, $text_y, "Your Bill", $black);
$text_y += 20;

// Add column headers
imagestring($image, $font, $text_x, $text_y, "Product Name", $black);
imagestring($image, $font, $text_x + 300, $text_y, "Price (₹)", $black);
imagestring($image, $font, $text_x + 400, $text_y, "Quantity", $black);
imagestring($image, $font, $text_x + 500, $text_y, "Total (₹)", $black);
$text_y += 20;

// Draw a separator line
imageline($image, 0, $text_y, $image_width, $text_y, $gray);
$text_y += 10;

// Add product details
$total_price = 0;
foreach ($_SESSION['cart'] as $product) {
    $product_name = $product['name'];
    $price = $product['price'];
    $quantity = $product['quantity'];
    $total = $price * $quantity;
    $total_price += $total;

    imagestring($image, $font, $text_x, $text_y, $product_name, $black);
    imagestring($image, $font, $text_x + 300, $text_y, "₹" . $price, $black);
    imagestring($image, $font, $text_x + 400, $text_y, $quantity, $black);
    imagestring($image, $font, $text_x + 500, $text_y, "₹" . $total, $black);
    $text_y += 20;
}

// Draw a separator line above the total
$text_y += 10;
imageline($image, 0, $text_y, $image_width, $text_y, $gray);
$text_y += 10;

// Add total price
imagestring($image, $font, $text_x, $text_y, "Grand Total:", $black);
imagestring($image, $font, $text_x + 500, $text_y, "₹" . $total_price, $black);

// Send the image to the browser
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="Bill.png"');
imagepng($image);

// Free up memory
imagedestroy($image);
?>
