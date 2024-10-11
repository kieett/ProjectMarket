<?php
function connectDB(){
    $servername = "localhost";
    $username = "admin000";
    $password = "123";
    $dbname = "quanly_sieuthi";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}
?>