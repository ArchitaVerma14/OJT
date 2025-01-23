<?php include("database.php"); ?>

<?php
  if(isset($_POST['submit'])){
    $Product_name = $_POST['Product_name'];
    $Photo = $_POST['Photo'];
    $Rate = $_POST['Rate'];

    //echo $name.' '.$rollno.' '.$course;

    $sql = "INSERT INTO student1 (sname,rollno, course)value('$name', '$rollno','$course')";

    if($conn->query($sql)){
        echo "Data Inserted";
    }else{
        echo $conn->error;
    }
}



if(isset($_GET['del_roll'])){
    $rollno = $_GET['del_roll'];
    $sql = "DELETE FROM student1 WHERE rollno=$rollno";

    if($conn->query($sql)){
        echo "Data Deleted";
    }else{
        echo $conn->error;
    }
}
if(isset($_POST['update'])) {
    $rollno = $_POST['rollno'];
    $new_sname = $_POST['name'];
    $new_course = $_POST['course'];

    $sql = "UPDATE student1 SET 
            sname = '$new_sname', 
            course = '$new_course' 
            WHERE rollno = '$rollno'";

    if($conn->query($sql)) {
        echo "Data updated successfully";
    } else {
        echo $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="insert.php" method="POST">
    <h1>Insert Data</h1>
    <input type="text" name="name" placeholder="Enter name" class="form-control"/> 
    <input type="text" name="rollno" placeholder="Enter roll no" class="form-control"/> 
    <input type="text" name="course" placeholder="Enter course" class="form-control"/>
    <input type="submit" value="Insert Data" class="btn btn-primary" name="submit"/> 
    <input type="submit" value="update Data" class="btn btn-primary" name="update"/>
    <!-- <input type="submit" value="Login" class="btn btn-primary" name="login"/> -->
    <input type="submit" value="Sign Up" class="btn btn-primary" name="sign_up"/>
    <!--<button onclick="document.location='login.php'">Login </button> -->
    <a href="login.php" class="btn btn-primary">Login</a>
</form>
<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Rollno</th>
        <th>Course</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    // Select or Fetch
    $sql = "SELECT * FROM student1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row['sname'];
            $rollno = $row['rollno'];
            $course = $row['course'];

            //echo "$id, $name, $rollno, $course<hr/>";

            echo '<tr>
                <td>'.$name.'</td>
                <td>'.$rollno.'</td>
                <td>'.$course.'</td>
                <td><a onclick="return confirm(\'Are you sure?\')" href="?del_roll='.$rollno.'">Delete</a></td>
                  <td><a onclick="return confirm(\'Are you sure?\')" href="?upd_roll='.$rollno.'">Update</a></td>
            </tr>';
        }
    }
    ?>
    </tbody>   
</table>
</body>
</html>