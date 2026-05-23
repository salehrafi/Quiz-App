<?php
    include "conn.php";
    session_start();

    // echo "this is a login page";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM USERS WHERE username = '$username' AND password = '$password'";
        $query_result = $conn->query($sql);

        if($query_result->num_rows>0){
            echo "Login Successful.";
            $_SESSION['username'] = $username;
            $_SESSION['logged-in'] = true;
            header("Location: /core_func/studentDashboard.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Quiz App</title>

    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 700;
            background-color: antiquewhite;
        }
        form{
            background-color: aliceblue;
            height: fit-content;
            width: max-content;
            border: 2px solid black;
            display: flex;
            flex-direction: column;
            padding: 20px;
            gap: 5px;
            border-radius: 10px;
        }
        #login-header{
            text-align: center;
        }
        #username, #password {
            height: 30px;
        }
        #reg-hint{
            font-weight: normal;
            font-style: italic;
        }
        #reg-hint a{
            font-weight: bold;
        }
        #login{
            gap: 10px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1 id="login-header">System Log-In</h1>
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" id="username" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <input type="submit" name="submit" id="login" value="Login">
        <p id="reg-hint">First time user? <a href="registration.php">Click Here</a> to sign up a new account!</p>
    </form>
    
</body>
</html>