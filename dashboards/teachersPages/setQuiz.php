<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Quiz</title>
    <link rel="stylesheet" href="../navStyle.css">
</head>

<body>
    <nav>
        <div class="left-nav">
            <ul class="navBar">
                <li><a href="../teacherDashboard.php" >Home</a></li>
                <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="active">Set Quiz</a></li>
                <li><a href="teachersPages/results.php">Results</a></li>
                <li><a href="teachersPages/student_profile.php">Students Profile</a></li>
                <li><a href="teachersPages/questions.php">Questions</a></li>
                <li><a href="teachersPages/password_issue.php">Password Issue</a></li>
            </ul>
        </div>

        <div class="right-nav">
            <a href="../../auth/logout.php" class="logout-btn">Log Out, <?php echo $_SESSION['name'] ?></a>
        </div>
    </nav>
</body>

</html>