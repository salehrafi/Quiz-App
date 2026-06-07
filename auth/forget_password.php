<?php
session_start();

include '../db/conn.php';
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

define('EMAIL', $_ENV['email']);
define('PWD', $_ENV['password']);

$success = "";
$error = "";
$otp_code = rand(1000, 9999);
$mail_address = "";
$mail_body = "
<div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
    <p>Dear User,</p>
    <p>Your One-Time Password (OTP) is:</p>
    <p style='font-size: 20px; font-weight: bold; color: #4f46e5; letter-spacing: 2px;'>
        $otp_code
    </p>
    <p>Please do not share this OTP with anyone.</p>
    <p>Thank you,<br><strong>Security Team</strong></p>
</div>";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail_address = $_POST['mailTo'];
}

$validation_sql = "SELECT * FROM reg_info WHERE email = '$mail_address'";
$res = $conn->query($validation_sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail_address = $_POST['mailTo'];
    $_SESSION['email'] = $mail_address;
    $validation_sql = "SELECT * FROM reg_info WHERE email = '$mail_address'";
    $res = $conn->query($validation_sql);

    if ($res->num_rows > 0) {
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = EMAIL;
            $mail->Password = PWD;
            $mail->Port = 587;

            $mail->setFrom(EMAIL, 'OTP Admin');
            $mail->addAddress($mail_address);

            $mail->isHTML(true);
            $mail->Subject = "OTP Verification";
            $mail->Body = $mail_body;

            $mail->send();

            $exp_time = date("Y-m-d H:i:s", strtotime("+2 minutes"));
            $inputsql = "UPDATE reg_info SET otp='$otp_code', exp_time='$exp_time' WHERE email='$mail_address'";
            $conn->query($inputsql);

            header("Location: otp_verification.php");
            exit;
        } catch (Exception $e) {
            $error = "OTP Email send failed " . $mail->ErrorInfo;
        }
    } else {
        $error = "Email is not registered in our system";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forget Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" class="email-form">
        <h3 class="banner">Forget Password</h3>
        <input type="text" name="mailTo" placeholder="Type your email address" required>
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="submit" value="Send OTP">
    </form>
</body>
</html>