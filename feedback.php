<?php include("database.php"); ?>

<?php
$message = ""; // Initialize a message variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $opinion = $conn->real_escape_string($_POST['opinion']);

    // Insert data into the feedback table
    $sql = "INSERT INTO feedback (fullname, email, opinion) VALUES ('$fullname', '$email', '$opinion')";

    if ($conn->query($sql) === TRUE) {
        $message = "Feedback submitted successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
    <link rel="stylesheet" type="text/css" href="feedback.css">
    <style>
        .message {
            color: white;
            font-weight: bold;
            margin-bottom: 0px;
            text-align:center;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Display success or error message -->
    <?php if ($message): ?>
        <div class="<?php echo strpos($message, 'Error') === false ? 'message' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form action="feedback.php" method="POST">
        <h1>Feedback</h1>
        <div class="id">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <i class="far fa-user"></i>
        </div>
        <div class="id">
            <input type="email" name="email" placeholder="Email" required>
            <i class="far fa-envelope"></i>
        </div>
        <textarea name="opinion" cols="15" rows="5" placeholder="Enter your opinions here.." required></textarea>
        <button type="submit">Send</button>
    </form>
</div>
</body>
</html>
