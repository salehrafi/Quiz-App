<?php
session_start();
include '../db/conn.php';

$success = "";
$error = "";
$email = $_SESSION['email'] ?? null;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    if($pass === $repass){
        $sql = "UPDATE reg_info SET pass = '$pass' WHERE email = '$email'";
        $conn->query($sql);
        $success = "Password Matched and Updated Successfully";
        header("Location: login.php");
        exit;
    }else{
        $error = "Password Not matched";
    }
}

// echo "password changed";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Change</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="POST" class="email-form">
        <h3 class="banner">Password Change</h3>
        <input type="password" name="pass" placeholder="Enter a new password" required>
        <input type="password" name="repass" placeholder="Re-enter your password" required>
        <input type="submit" value="Change Password">
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</body>

</html>