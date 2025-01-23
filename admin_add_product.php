<!DOCTYPE html>
<html>
<link rel="stylesheet" href="admin_add_product.css">
<head>
    <title>Add Food Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_prod.php" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>
        
        <label for="category">Category:</label><br>
        <select id="category" name="category" required>
            <option value="" disabled selected>Select a category</option>
            <option value="dog_food">Dog Food</option>
            <option value="cat_food">Cat Food</option>
            <option value="bird_food">Bird Food</option>
            <option value="fish_food">Fish Food</option>
            <option value="rabbit_food">Rabbit Food</option>
            <option value="turtle_food">Turtle Food</option>
        </select><br><br>
        
        <label for="photo">Photo:</label><br>
        <input type="file" id="photo" name="photo" accept="uploads/*" required><br><br>
        
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
