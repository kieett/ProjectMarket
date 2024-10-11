<?php
session_start(); 

if (!isset($_SESSION['uid'])) {
    echo json_encode(['status' => 'error', 'message' => 'Người dùng chưa đăng nhập']);
    exit();
}

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $cart = $data['cart']; 
    $tongtien = $data['tongtien']; 
    $uid = $_SESSION['uid']; 

    // Thêm hóa đơn vào bảng `hoadon`
    $stmt = $mysqli->prepare("INSERT INTO hoadon (uid, tongtien, trangthai, ngaytao) VALUES (?, ?, ?, NOW())");
    $trangthai = 'Đã thanh toán';
    $stmt->bind_param('ids', $uid, $tongtien, $trangthai);
    $stmt->execute();
    $mahd = $stmt->insert_id; 

    // Thêm từng sản phẩm vào bảng `chitiethoadon`
    foreach ($cart as $item) {
        $stmt = $mysqli->prepare("INSERT INTO chitiethoadon (MaHD, MaSP, soluong, giaban) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiid', $mahd, $item['MaSP'], $item['soluong'], $item['giaban']);
        $stmt->execute();
    }

    echo json_encode(['status' => 'success', 'message' => 'Thanh toán thành công!']);
}
?>
