<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('error_log', 'C:/xampp/htdocs/website-py/Graphics/login/php_errors.log');
session_start();

$servername = "localhost";
$username = "admin000";
$password = "123";
$dbname = "quanly_sieuthi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Kết nối thất bại: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taikhoan = trim($_POST['taiKhoan'] ?? '');
    $matkhau = trim($_POST['matKhau'] ?? '');

    $sql = "SELECT `uid`, matkhau, `role` FROM customer WHERE taikhoan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $taikhoan);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($uid, $stored_password, $role);
            $stmt->fetch();

            error_log("Mật khẩu từ cơ sở dữ liệu: " . $stored_password);
            error_log("Mật khẩu người dùng nhập vào: " . $matkhau);
            error_log("role: " . $role);

        
            if ($matkhau === $stored_password) {
                $_SESSION['uid'] = $uid;
                $_SESSION['username'] = $taikhoan;
                $_SESSION['role'] = $role;
             
                if ($role === 1) {
                    echo json_encode(["success" => true, "message" => "Đăng nhập thành công với vai trò admin!", "redirect" => "http://localhost/website-py/admin/GDadmin/Giaodien.php"]);
                } else {
                    echo json_encode(["success" => true, "message" => "Đăng nhập thành công với vai trò người dùng!", "redirect" => "http://localhost/website-py/Graphics/main/Giaodienchinh.php"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Mật khẩu không đúng."]);
            }
            
        } else {
            echo json_encode(["success" => false, "message" => "Tài khoản không tồn tại."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi thực hiện truy vấn."]);
    }

    $stmt->close();
}

$conn->close();
?>
