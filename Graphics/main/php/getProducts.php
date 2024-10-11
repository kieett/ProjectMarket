<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

if (!function_exists('getConnection')) {
    function getConnection() {
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
}

if (!function_exists('getProductsByCategory')) {
    function getProductsByCategory($category) {
        $conn = getConnection();

        $sql = "SELECT MaSP, ten, giaban, giacu, image, donvi FROM sanpham WHERE phanloai = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        $stmt->close();
        $conn->close();

        return $products;
    }
}
?>