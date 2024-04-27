<?php
session_start();
$host = 'localhost';
$dbname = 'auction';
$dbusername = 'root';
$dbpassword = '';


$conn = mysqli_connect($host,$dbusername,$dbpassword,$dbname);

if(mysqli_connect_errno()){
    echo "Failed to connect to Mysql: " . mysqli_connect_error();
}


?>
