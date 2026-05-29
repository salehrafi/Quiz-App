<?php
include "../db/conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['user_type']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO reg_info (id, name, email, pass, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare Failed: " . $conn->error);
    }

    $stmt->bind_param("issss", $id, $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $flag = "YES";
        // echo "Registration Successful!";
    } else {
        $flag = "NO";
        die("Insert Failed: " . $stmt->error);
    }

    $stmt->close();
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

        <label for="id">ID</label>
        <input type="text" name="id" id="id" placeholder="Enter ID">

        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Enter Name" required>

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Institutional E-mail" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" minlength="8" maxlength="16"
            required>

        <div class="radio-group">
            <label>Role:</label>
            <label>
                <input type="radio" name="user_type" value="teacher" required>
                Teacher
            </label>
            <label>
                <input type="radio" name="user_type" value="student">
                Student
            </label>
        </div>
        <p id="status"></p>
        <button type="submit" id="login">Sign Up</button>
        <p id="reg-hint">
            Already have an account?
            <a href="login.php">Click Here</a> to log in!
        </p>
    </form>

    <script>
        <?php if ($flag == "YES"): ?>
            document.getElementById("status").innerHTML = "User created successful";
            document.getElementById("status").style.color = "green";
            setTimeout(function () {
                window.location.href = 'login.php';
            }, 2000);
        <?php elseif ($flag == "NO"): ?>
            document.getElementById("status").innerHTML = "Something wents wrong";
            document.getElementById("status").style.color = "red";
        <?php endif; ?>
    </script>
</body>

</html>