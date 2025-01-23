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

$sql = "SELECT * FROM image";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Our Products</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<p>Price: ₹" . $row['price'] . "</p>";
            echo "<img src='" . $row['photo'] . "' alt='" . $row['name'] . "' style='width:200px; height:auto;'><br>";
            echo "</div><hr>";
        }
    } else {
        echo "No products available.";
    }
    $conn->close();
    ?>
</body>
</html>
