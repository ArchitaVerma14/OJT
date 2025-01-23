<!DOCTYPE html>
<html>
<link rel="stylesheet" href="admin_add_product.css">

<head>
    <title>Add Accessories</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" min="0" required><br><br>

        
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>
        
        <label for="photo">Photo:</label><br>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
        
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
