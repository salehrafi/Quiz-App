<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: ../auth/login.php");
    exit();
}

// echo "this is a dashboard!!";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navStyle.css">
    <title>Student Dashboard</title>
</head>

<body>
<nav>
    <div class="left-nav">
        <ul class="navBar">
            <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Home</a></li>
            <li><a href="#">Quizzes</a></li>
            <li><a href="#">Results</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Notifications</a></li>
        </ul>
    </div>

    <div class="right-nav">
        <a href="../auth/logout.php" class="logout-btn">Log Out, <?php echo $_SESSION['name'] ?></a>
    </div>
</nav>

    
</body>

</html>