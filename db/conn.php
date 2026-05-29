<?php

    $db = "localhost";
    $userName = "root";
    $pass = "";
    $dbName = "quiz_app";

    $sql = "CREATE TABLE IF NOT EXISTS reg_info(
        id VARCHAR(50) UNIQUE,
        name VARCHAR(50),
        email VARCHAR(100) UNIQUE,
        pass VARCHAR(255),
        role VARCHAR(20)
    )";

    $conn = new mysqli($db, $userName, $pass, $dbName);

    if($conn -> connect_error){
        die("Connection Failed! ". $conn->connect_error);
    }

    if($conn->query($sql) === true){
        // echo "Database created or exists";
    }else{
        die("Something wents wrong ". $conn->error);
    }

?>