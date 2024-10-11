<?php
$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Truy vấn tổng số lượng sản phẩm
$sql = "SELECT SUM(soluong) as total_quantity FROM sanpham";
$result = $conn->query($sql);

$total_quantity = 0; 

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_quantity = $row['total_quantity']; 
}
$conn->close();
echo json_encode(['total_quantity' => $total_quantity]);
?>
