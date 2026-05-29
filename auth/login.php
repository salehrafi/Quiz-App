<?php
include "../db/conn.php";
session_start();

if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['role'] === 'student') {
        header("Location: ../dashboards/studentDashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'teacher') {
        header("Location: ../dashboards/teacherDashboard.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT name, email, pass, role FROM reg_info WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['pass'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;

            if ($user['role'] === 'student') {
                header("Location: ../dashboards/studentDashboard.php");
            } elseif ($user['role'] === 'teacher') {
                header("Location: ../dashboards/teacherDashboard.php");
            }

            exit();
        }
    }

    $error = "Invalid Username or Password";
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

    <form action="" method="POST">
        <h1 id="login-header">System Log-In</h1>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password" minlength="8" maxlength="16"
            required>
        <button type="submit" id="login">Login</button>

        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <p id="reg-hint">First time user? <a href="registration.php">Click Here</a> to sign up!</p>
    </form>

</body>

</html>