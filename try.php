<?php include("database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Food Shop - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #34495e;
        }
        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar ul li a:hover {
            background-color: #34495e;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ecf0f1;
            border-bottom: 1px solid #bdc3c7;
        }
        .header .search-bar {
            width: 300px;
        }
        .header .search-bar input {
            width: 100%;
            padding: 8px;
        }
        .header .user-profile {
            display: flex;
            align-items: center;
        }
        .header .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .dashboard-content {
            margin-top: 20px;
        }
        .dashboard-content .card {
            background-color: #ecf0f1;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .dashboard-content .card h3 {
            margin: 0 0 10px 0;
        }
        .dashboard-content .card table {
            width: 100%;
            border-collapse: collapse;
        }
        .dashboard-content .card table th, .dashboard-content .card table td {
            border: 1px solid #bdc3c7;
            padding: 10px;
            text-align: left;
        }
        .dashboard-content .card table th {
            background-color: #bdc3c7;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="acc.php"><i class="fas fa-box"></i> Add Products</a></li>
        <li><a href="admin_add_product.php"><i class="fas fa-box"></i> Add Food</a></li>

        <li><a href="admin_add_productacc.php"><i class="fas fa-box"></i> Add Accessories</a></li>
        <li><a href="order_details.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
        <li><a href="customer_list"><i class="fas fa-users"></i> Customers</a></li>
        <li><a href="sales_report.php"><i class="fas fa-chart-line"></i> Sales Report</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header">
        <div class="search-bar">
            <form method="GET" action="try.php">
                <input type="text" name="search_query" placeholder="Search by Product ID or Name..." value="<?php echo isset($_GET['search_query']) ? $_GET['search_query'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="user-profile">
            <img src="admin.png" alt="Admin Profile">
            <span>adminadmin</span>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="card">
            <h3>Overview</h3>
            <p>Total Products: 150</p>
            <p>Total Orders: 320</p>
            <p>Total Customers: 200</p>
        </div>

        <div class="card">
            <h3>Recent Orders</h3>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch orders from the database
                    $sql = "SELECT * FROM orders ORDER BY order_date DESC";
                    $result = mysqli_query($conn, $sql);

                    // Check if query is successful and there are rows
                    if ($result && mysqli_num_rows($result) > 0) {
                        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    } else {
                        $orders = [];
                        echo "No orders found.";
                    }

                    // Loop through orders and display them
                    foreach ($orders as $order) {
                        echo '<tr>';
                        echo '<td>#' . $order['order_id'] . '</td>';
                        echo '<td>' . $order['customer_name'] . '</td>';
                        echo '<td>$' . number_format($order['total_amount'], 2) . '</td>';
                        echo '<td>' . $order['order_status'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Top Selling Products</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Initialize products as an empty array
                    $products = [];

                    if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
                        $search_query = mysqli_real_escape_string($conn, $_GET['search_query']); // Sanitize user input

                        // Query to search products by id or name
                        $sql = "SELECT * FROM image 
                                WHERE id LIKE '%$search_query%' 
                                OR name LIKE '%$search_query%' 
                                ORDER BY name ASC";
                    } else {
                        // Default query to fetch all products if no search query
                        $sql = "SELECT * FROM image ORDER BY name ASC";
                    }

                    $result = mysqli_query($conn, $sql);

                    // Check if query is successful and there are rows
                    if ($result && mysqli_num_rows($result) > 0) {
                        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    } else {
                        echo "<tr><td colspan='4'>No products found.</td></tr>";
                    }

                    // Loop through products and display them
                    foreach ($products as $product) {
                        echo '<tr>';
                        echo '<td>' . $product['name'] . '</td>';
                        echo '<td>' . $product['description'] . '</td>';
                        echo '<td>' . number_format($product['price'], 2) . '</td>';
                        echo '<td>' . $product['quantity'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
