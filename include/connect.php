<?php
    $host_name  = "***********";
    $database   = "***********";
    $user_name  = "***********";
    $password   = "***********";

    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>