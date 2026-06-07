<?php
session_start();

include '../db/conn.php';
$success = "";
$error = "";
$email = $_SESSION['email'] ?? null;

if (!$email) {
    die("Session expired.");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $otp = $_POST['otp1'] . $_POST['otp2'] . $_POST['otp3'] . $_POST['otp4'];
    $sql = "SELECT otp, exp_time FROM reg_info WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        if ($row['otp'] == $otp && time() < strtotime($row['exp_time'])){
            $success = "OTP Verified.";
            $conn->query("UPDATE reg_info SET otp = NULL, exp_time = NULL WHERE email = '$email'");
            header("Location: password_change.php");
            exit;
        } else {
            $error = "OTP not matched or expired.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <form method="POST" class="email-form">
        <h2 class="banner">OTP Verification</h2>
        <p class="otp-text">Enter the 4-digit code sent to your email</p>
        <div class="otp-row">
            <input type="text" name="otp1" maxlength="1" required>
            <input type="text" name="otp2" maxlength="1" required>
            <input type="text" name="otp3" maxlength="1" required>
            <input type="text" name="otp4" maxlength="1" required>
        </div>
        <input type="submit" value="Verify OTP">
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</body>

</html>