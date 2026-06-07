<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('server_name', $_ENV['server_name']);
define('db_name', $_ENV['db_name']);
define('username', $_ENV['username']);
define('password', $_ENV['db_password']);

$conn = new mysqli(server_name, username, password, db_name);
$sql = "CREATE TABLE IF NOT EXISTS reg_info(
        id VARCHAR(50) UNIQUE,
        full_name VARCHAR(50),
        email VARCHAR(100) UNIQUE,
        pass VARCHAR(255),
        role VARCHAR(20),
        otp INT,
        exp_time DATETIME
    )";


if ($conn->connect_error) {
    die("Connection Failed! " . $conn->connect_error);
}

if ($conn->query($sql) === true) {
    // echo "Database created or exists";
} else {
    die("Something wents wrong " . $conn->error);
}
