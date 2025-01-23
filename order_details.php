<?php
include("database.php");

// Fetch order ID from the URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;

if ($order_id > 0) {
    // Fetch order details from the database
    $sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);  // Store the order data in $order
    } else {
        $order = null;
        echo "Order not found.";
    }
} else {
    echo "Invalid order ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Pet Food Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Your styles here... */
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="admin_dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header">
        <!-- Your header code -->
    </div>

    <div class="dashboard-content">
        <?php if ($orders) { ?>
            <div class="card">
                <h3>Order Details</h3>
                <table>
                    <tr>
                        <th>Order ID</th>
                        <td><?php echo '#' . $order['order_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td><?php echo $order['customer_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?php echo $order['order_status']; ?></td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td><?php echo $order['order_date']; ?></td>
                    </tr>
                </table>
            </div>

            <!-- You can also show order items (if stored separately) -->
            <div class="card">
                <h3>Ordered Items</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch ordered items for the given order
                        $sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
                        $result_items = mysqli_query($conn, $sql_items);

                        if ($result_items && mysqli_num_rows($result_items) > 0) {
                            while ($item = mysqli_fetch_assoc($result_items)) {
                                echo '<tr>';
                                echo '<td>' . $item['product_name'] . '</td>';
                                echo '<td>' . $item['quantity'] . '</td>';
                                echo '<td>$' . number_format($item['price'], 2) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">No items found for this order.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
