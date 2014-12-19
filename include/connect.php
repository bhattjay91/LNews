<?php
    $host_name  = "db557259234.db.1and1.com";
    $database   = "db557259234";
    $user_name  = "dbo557259234";
    $password   = "Apple123!123";

    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>