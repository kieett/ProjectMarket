<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Kết nối thất bại: " . $conn->connect_error]));
}
$conn->set_charset("utf8");

// Lấy thông tin người dùng
$taikhoan = $_SESSION['username'];
$stmt = $conn->prepare("SELECT taikhoan,name, address, email, sdt, img FROM customer WHERE taikhoan = ?");
$stmt->bind_param("s", $taikhoan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(['success' => true, 'taikhoan' => $user['taikhoan'], 'data' => $user]);
} else {
    echo json_encode(['success' => false, 'message' => 'Không tìm thấy thông tin người dùng.']);
}

$conn->close();
?>
