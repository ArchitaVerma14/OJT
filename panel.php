<?php
    // Database connection
    include("database.php");
?>
<?php
    // Check cookie
    if(isset($_COOKIE['token'])){
        echo "Logged";
        $id = $_COOKIE['id'];
    }else{
        //echo ' <meta http-equiv="refresh" content="0;url=login.php">';
        echo "Please login to use panel";
        exit(0);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Panel</h1>
    <p>This is my user panel</p>

    <?php
        // Fetch user details
        $sql = "SELECT * FROM user WHERE id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row["fullname"];
            echo '<h1>Hello, '.$name.'</h1>';
        }
    }
    ?>

    <a href="logout.php">Logout</a>
</body>
</html>