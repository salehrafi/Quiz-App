<?php

    $db = "localhost";
    $userName = "root";
    $pass = "";
    $dbName = "quiz_app";

    $sql = "CREATE TABLE IF NOT EXISTS student_info(
        std_id VARCHAR(50),
        std_name VARCHAR(50),
        std_email VARCHAR(50),
        pass VARCHAR(50)
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