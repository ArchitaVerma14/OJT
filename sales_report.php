<?php
// Start the session
session_start();

// Include database connection
include("database.php");

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the product from the database
    $delete_sql = "DELETE FROM image WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully!'); window.location.href='sales_report.php';</script>";
    } else {
        echo "<script>alert('Failed to delete product. Please try again.');</script>";
    }

    $stmt->close();
}

// Handle update action
if (isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $update_quantity = (int)$_POST['update_quantity'];

    // Update the product quantity
    $update_sql = "UPDATE image SET quantity = quantity + ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ii", $update_quantity, $update_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product quantity updated successfully!'); window.location.href='sales_report.php';</script>";
    } else {
        echo "<script>alert('Failed to update product quantity. Please try again.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }
    h1 {
      text-align: center;
      margin-top: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px auto;
      overflow-x: auto;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #f4f4f4;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    img {
      width: 50px;
      height: auto;
    }
    .delete-button, .update-button {
      padding: 8px 12px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 14px;
    }
    .delete-button {
      background-color: #f44336;
      color: white;
    }
    .update-button {
      background-color: #4CAF50;
      color: white;
    }
    .out-of-stock {
      color: red;
      font-weight: bold;
    }
    form {
      display: inline-block;
      margin: 0;
    }
    input[type="number"] {
      width: 80px;
      padding: 5px;
      margin-right: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      th {
        text-align: left;
      }
      tr {
        margin-bottom: 15px;
      }
      td {
        text-align: left;
        padding-left: 50%;
        position: relative;
      }
      td:before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
      }
      img {
        width: 30px;
      }
      .delete-button, .update-button {
        font-size: 12px;
        padding: 5px 8px;
      }
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 18px;
        margin-top: 10px;
      }
      input[type="number"] {
        width: 60px;
        padding: 3px;
      }
    }
  </style>
</head>
<body>

  <h1>Product Report</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Price (₹)</th>
        <th>Quantity</th>
        <th>Photo</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Fetch all products from the database
      $sql = "SELECT * FROM image";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Loop through each product and display it in the table
          while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td data-label="ID">' . htmlspecialchars($row['id']) . '</td>';
              echo '<td data-label="Product Name">' . htmlspecialchars($row['name']) . '</td>';
              echo '<td data-label="Description">' . htmlspecialchars($row['description']) . '</td>';
              echo '<td data-label="Price">' . htmlspecialchars($row['price']) . '</td>';
              echo '<td data-label="Quantity">' . htmlspecialchars($row['quantity']) . '</td>';
              echo '<td data-label="Photo"><img src="' . htmlspecialchars($row['photo']) . '" alt="' . htmlspecialchars($row['name']) . '"></td>';
              echo '<td data-label="Status">' . ($row['quantity'] > 0 ? 'In Stock' : '<span class="out-of-stock">Out of Stock</span>') . '</td>';
              echo '<td data-label="Actions">
                      <a href="sales_report.php?delete_id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this product?\')">
                        <button class="delete-button">Delete</button>
                      </a>
                      <form method="POST" action="">
                        <input type="hidden" name="update_id" value="' . $row['id'] . '">
                        <input type="number" name="update_quantity" placeholder="Qty" required>
                        <button type="submit" class="update-button">Update</button>
                      </form>
                    </td>';
              echo '</tr>';
          }
      } else {
          echo '<tr><td colspan="8">No products found.</td></tr>';
      }

      // Close the database connection
      $conn->close();
      ?>
    </tbody>
  </table>

</body>
</html>
