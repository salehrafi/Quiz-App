<?php

    $db = "localhost";
    $userName = "root";
    $pass = "";
    $dbName = "quiz_login";

    $sql = "CREATE TABLE IF NOT EXISTS login(
        username VARCHAR(50),
        pass VARCHAR(50)
    )";

    $conn = new mysqli($db, $userName, $pass, $dbName);

    if($conn -> connect_error){
        die("Connection Failed! ". $conn->connect_error);
    }

    if($conn->query($sql) === true){
        echo "Database created or exists";
    }else{
        die("Something wents wrong ". $conn->error);
    }

?>