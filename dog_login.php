<?php
include("database.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user is the admin
    if ($email === 'admin@gmail.com' && $password === 'admin') {
        // Directly redirect to the admin panel
        header("Location: try.php");
        exit();
    }

    // Fetch user record securely to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $flag = 0;
    $user = null;

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_password = $user['password']; // Stored hashed password

        // Compare the stored hashed password with the entered password
        if (password_verify($password, $stored_password)) {
            $flag = 1; // Login success
        } else {
            $flag = 2; // Incorrect password
        }
    } else {
        $flag = 0; // No account found
    }

    // Handle login outcome
    if ($flag == 1) {
        $id = $user['id'];
        $token = bin2hex(random_bytes(16)); // Generate a stronger token using random_bytes()

        $update_sql = "UPDATE user SET token = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $token, $id);

        if ($update_stmt->execute()) {
            // Set cookies for token and user ID
            setcookie("token", $token, time() + (60 * 60 * 24 * 30), "/");
            setcookie("id", $id, time() + (60 * 60 * 24 * 30), "/");

            echo "User logged in";
            echo '<meta http-equiv="refresh" content="0;url=acc.php">';
        } else {
            echo "Error updating token: " . $conn->error;
        }
    } else if ($flag == 2) {
        echo "Incorrect password";
    } else {
        echo "No account found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dog Login</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="login.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <style>
        .lottie-container {
            display: flex;
            justify-content: flex-start;
            padding-left: 200px;
        }
        .btn {
            display: block;
            width: 50%;
            margin: 10px 0;
            text-align: center;
        }
        .gif-container {
            position: fixed;
            bottom: 20px;
            right: 50px;
            width: 300px;
            height: 500px;
            z-index: 1000;
        }
        .gif-container img {
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>
    <div class="whole">
        <div class="login">
            <form action="dog_login.php" method="post">
                <i class="fa fa-user" aria-hidden="true">&nbsp;&nbsp;</i>
                <input type="email" name="email" placeholder="Email" required><br><br>
                <i class="fa fa-unlock-alt" aria-hidden="true">&nbsp;&nbsp;</i>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <button type="submit" name="submit" class="btn btn-info">Sign In</button>
            </form>
            <p>If you are new here, <a href="signup.php">Signup</a></p>
        </div>

        <div class="backg">
            <div class="dog">
                <!-- Animation code for dog -->
            </div>
        </div>
    </div>
</body>
</html>
