<?php
session_start();
ob_start();

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Kết nối thất bại: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    
    if ($action === "check_account") {
        $taikhoan = $_POST['taikhoan'];

        // Kiểm tra tài khoản có tồn tại không
        $stmt = $conn->prepare("SELECT * FROM customer WHERE taikhoan = ?");
        $stmt->bind_param("s", $taikhoan);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Tài khoản hợp lệ.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tài khoản không tồn tại.']);
        }
        $stmt->close();
    }

    if ($action === "reset_password") {
        $taikhoan = $_POST['taikhoan'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'Mật khẩu không khớp.']);
            exit();
        }

        $stmt = $conn->prepare("UPDATE customer SET matkhau = ? WHERE taikhoan = ?");
        $stmt->bind_param("ss", $new_password, $taikhoan);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Đặt lại mật khẩu thành công.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Đặt lại mật khẩu không thành công.']);
        }

        $stmt->close();
    }
}

$conn->close();
?>
