<?php
$order_id = $_GET['order_id'] ?? 'Unknown';
$total = $_GET['total'] ?? '0.00';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
    <header>
        <h1>Thank You!</h1>
    </header>

    <main>
        <p>Your order has been placed successfully!</p>
        <p>Order ID: <?php echo htmlspecialchars($order_id); ?></p>
        <p>Total Amount Paid: ₹<?php echo htmlspecialchars($total); ?></p>

        <a href="generate_png.php?order_id=<?php echo htmlspecialchars($order_id); ?>&total=<?php echo htmlspecialchars($total); ?>">
            <button>Download Bill</button>
        </a>
    </main>

  
</body>
</html>
