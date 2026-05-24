<?php
    include "../db/conn.php";
    session_start();

    // echo "this is a login page";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM student_info WHERE std_email = '$username' AND pass = '$password'";
        $query_result = $conn->query($sql);

        if($query_result->num_rows>0){
            $_SESSION['username'] = $username;
            $_SESSION['logged-in'] = true;
            header("Location: ../dashboards/studentDashboard.php");
            exit();
        }else{
            $error= "Invalid Username or Password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Quiz App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1 id="login-header">System Log-In</h1>
        <label>Email</label>
        <input type="text" name="username" placeholder="Email" id="username" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" minlength="8" maxlength="16" id="password" required>

        <input type="submit" name="submit" id="login" value="Login">

        <?php if(!empty($error)){ ?>
        <p style="color:red; margin-top:10px;">
        <?php echo $error; ?>
        </p>
        <?php } ?>

        <p id="reg-hint">First time user? <a href="registration.php">Click Here</a> to sign up a new account!</p>
    </form>
    
</body>
</html>