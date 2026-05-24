<?php
    include "../db/conn.php";
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['std_id'];
        $name = $_POST['std_name'];
        $email = $_POST['std_email'];
        $password = $_POST['password'];

    $sql = "INSERT INTO student_info VALUES('$id', '$name', '$email', '$password')";

    if($conn->query($sql) === true){
        header("Location: login.php");
        exit();
    }else{
        die("Something wents wrong while inserting ". $conn->error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration to this system || Insert your infromation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <h1 id="login-header">System Registration</h1>
        <label>ID</label>
        <input type="text" placeholder="Student ID" id="std_ID" name="std_id" required>
        <label>Name</label>
        <input type="text" name="std_name" placeholder="Student Name" id="std_name">
        <label>Student E-mail</label>
        <input type="email" placeholder="Student E-mail" id="username" name="std_email">
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Password" minlength="8" maxlength="16" required>
        <input type="submit" name="submit" id="login" value="Sign Up">
        <p id="reg-hint">Already have an account? <a href="login.php">Click Here</a> to log in!</p>

    </form>
    
</body>
</html>