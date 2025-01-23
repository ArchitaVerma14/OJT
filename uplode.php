<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload Image</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="productname">Product Name:</label><br>
        <input type="text" name="productname" id="productname" required><br><br>

        <label for="price">Price:</label><br>
        <input type="number" name="price" id="price" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="photo">Photo:</label><br>
        <input type="file" name="photo" id="photo" accept="image/*" required><br><br>

        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>

<?php
// upload.php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pwc"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $productname = $_POST['productname'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle file upload
    $photo = $_FILES['photo'];
    $photoName = $photo['name'];
    $photoTmpName = $photo['tmp_name'];
    $photoSize = $photo['size'];
    $photoError = $photo['error'];
    $photoType = $photo['type'];

    $photoExt = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($photoExt, $allowed)) {
        if ($photoError === 0) {
            if ($photoSize < 5000000) { // 5MB limit
                $photoNewName = uniqid('', true) . "." . $photoExt;
                $photoDestination = 'uploads/' . $photoNewName;
                
                if (move_uploaded_file($photoTmpName, $photoDestination)) {
                    // Insert into database
                    $sql = "INSERT INTO image (productname, price, description, photo) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("siss", $productname, $price, $description, $photoNewName);

                    if ($stmt->execute()) {
                        header("Location: acc.php"); // Redirect to acc.php
                        exit();
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Failed to upload image.";
                }
            } else {
                echo "Your file is too large.";
            }
        } else {
            echo "There was an error uploading your file.";
        }
    } else {
        echo "You cannot upload files of this type.";
    }

    $conn->close();
}
?>
